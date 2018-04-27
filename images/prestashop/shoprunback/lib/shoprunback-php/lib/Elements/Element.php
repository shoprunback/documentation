<?php

namespace Shoprunback\Elements;

use Shoprunback\Shoprunback;
use Shoprunback\RestClient;
use Shoprunback\Util\Inflector;
use Shoprunback\Util\Logger;
use Shoprunback\Error\NotFoundError;
use Shoprunback\Error\RestClientError;
use Shoprunback\Error\ElementCannotBeUpdated;
use Shoprunback\Error\ElementCannotBeCreated;

abstract class Element
{
    public $id;

    public function __construct($id = '')
    {
        $this->id = $id;
        $this->_origValues = new \stdClass();

        if ($this->id != '') {
            $this->loadOriginal();
        }
    }

    public function __set($key, $value)
    {
        if (
            is_object($value)
            && isset($value->id)
            && (
                $this->belongsTo($key)
                || (
                    in_array($key, static::getAcceptedNestedElements())
                    && Inflector::isKnownElement($key)
                )
            )
        ) {
            $attributeId = $key . '_id';
            $this->$attributeId = $value->id;
        }

        if (Inflector::isKnownElement($key)) {
            $class = Inflector::classify($key);
            $setter = 'set' . $class;
            $this->$setter($value);
        } else {
            $this->$key = $value;
        }
    }

    public function __get($key)
    {
        if (Inflector::isKnownElement($key)) {
            $class = Inflector::classify($key);
            $fullClass = Inflector::getFullClassName($key);
            $getter = 'get' . $class;

            if (empty($this->$getter())) {
                if ($fullClass::canOnlyBeNested()) {
                    return null;
                }

                $classId = strtolower($class) . '_id';
                if (empty($this->$classId)) {
                    return null;
                }

                $setter = 'set' . $class;
                $this->$setter($fullClass::retrieve($this->$classId));
            }

            return $this->$getter();
        }

        if (isset($this->$key)) {
            return $this->$key;
        }

        return null;
    }

    abstract public function getAllAttributes();

    abstract public function getApiAttributesKeys();

    public function getAllNestedElements()
    {
        $nestedElements = [];
        foreach ($this->getAllAttributes() as $key => $element) {
            if (Inflector::isKnownElement(Inflector::getClass($element))) {
                $nestedElements[] = $element;
            }
        }

        return $nestedElements;
    }

    public static function getBelongsTo()
    {
        return [];
    }

    public static function getAcceptedNestedElements()
    {
        return [];
    }

    public static function canOnlyBeNested()
    {
        return false;
    }

    public function belongsTo($key)
    {
        return in_array($key, static::getBelongsTo());
    }

    public function acceptNestedAttribute($key)
    {
        return in_array($key, static::getAcceptedNestedElements());
    }

    public function display($elementString)
    {
        return $elementString . ' (' . $this->id . ')';
    }

    public static function getBaseEndpoint()
    {
        return Inflector::pluralize(static::getElementName());
    }

    public static function indexEndpoint($page = 1) {
        $endpoint = static::getBaseEndpoint();

        if ($page > 1) {
            $endpoint .= '?page=' . $page;
        }

        return $endpoint;
    }

    public static function showEndpoint($id) {
        return self::indexEndpoint() . '/' . $id;
    }

    public static function createEndpoint() {
        return self::indexEndpoint();
    }

    public static function updateEndpoint($id) {
        return self::indexEndpoint() . '/' . $id;
    }

    public static function deleteEndpoint($id) {
        return self::indexEndpoint() . '/' . $id;
    }

    public function loadOriginal()
    {
        if (!$this->isPersisted()) {
            $restClient = RestClient::getClient();

            try {
                if (isset($this->id) && $this->id != '') {
                    $response = $restClient->request(static::showEndpoint($this->id), \Shoprunback\RestClient::GET);
                } elseif ($this->getReference() != '') {
                    $response = $restClient->request(static::showEndpoint($this->getReference()), \Shoprunback\RestClient::GET);
                } else {
                    return;
                }
            } catch(RestClientError $e) {
                if ($e->response->getCode() == 404) {
                    return;
                } else {
                    throw $e;
                }
            }

            $originalObject = static::newFromMixed($response->getBody());
            unset($originalObject->_origValues);
            $this->_origValues = clone $originalObject;
        }
    }

    public function refresh()
    {
        $restClient = RestClient::getClient();

        try {
            if (isset($this->id) && !empty($this->id)) {
                $response = $restClient->request(static::showEndpoint($this->id), \Shoprunback\RestClient::GET);
            } else {
                $response = $restClient->request(static::showEndpoint($this->getReference()), \Shoprunback\RestClient::GET);
            }
        } catch(RestClientError $e) {
            self::logCurrentClass(json_encode($e));
            if ($e->response->getCode() == 404) {
                throw new NotFoundError('Not found');
            } else {
                throw $e;
            }
        }

        $this->copyValues(static::newFromMixed($response->getBody()));
    }

    public function save()
    {
        $this->loadOriginal();

        if ($this->isPersisted()) {
            if (static::canUpdate()) {
                $this->put();
            } else {
                $this->refresh();
            }
        } else {
            if (static::canCreate()) {
                $this->post();
            } else {
                throw new ElementCannotBeCreated(Inflector::getClass($this) . ' cannot be created');
            }
        }
    }

    private function post()
    {
        $restClient = RestClient::getClient();
        $data = $this->getElementBody();
        $response = $restClient->request(static::createEndpoint(), \Shoprunback\RestClient::POST, $data);
        $this->copyValues(static::newFromMixed($response->getBody()));
    }

    public function printElementBody()
    {
        echo $this . ': ' . json_encode($this->getElementBody(false)) . "\n";
    }

    public function getDirtyKeys()
    {
        $dirtyKeys = [];
        foreach ($this as $key => $value) {
            if (
                $key != 'id'
                && $this->isKeyDirty($key)
            ) {
                $dirtyKeys[] = $key;
            } elseif (!Inflector::isKnownElement($key)) {
                $keyPreged = preg_replace('/_id$/', '', $key);

                if ($keyPreged != $key && Inflector::isKnownElement($keyPreged) && $this->$keyPreged->id != $value) {
                    if (!empty($this->$keyPreged->id) && $this->$keyPreged->id != $this->_origValues->$key) {
                        $dirtyKeys[] = $key;
                    }

                    $keyToUnset = array_search($keyPreged, $dirtyKeys);
                    if ($keyToUnset && !$this->$keyPreged->isDirty()) {
                        unset($dirtyKeys[$keyToUnset]);
                    }
                }
            }

            // If nested element is a different one, but an unchanged one
            $keyToUnset = array_search($key, $dirtyKeys);
            if ($keyToUnset && Inflector::isKnownElement($key) && !$value->isDirty()) {
                unset($dirtyKeys[$keyToUnset]);
            }
        }

        return $dirtyKeys;
    }

    public function getApiAttributes()
    {
        $attributes = [];
        foreach ($this->getApiAttributesKeys() as $key) {
            if (property_exists($this, $key) || isset($this->$key) || $this->$key != null) {
                $attributes[$key] = $this->$key;
            }
        }

        return $attributes;
    }

    public function isDirty()
    {
        foreach ($this->getApiAttributes() as $key => $value) {
            if ($this->isKeyDirty($key)) {
                return true;
            }
        }

        return false;
    }

    public function isKeyDirty($key)
    {
        if ($key == '_origValues') {
            return false;
        }

        if (Inflector::isKnownElement($key)) {
            if (is_null($this->$key)) {
                return $this->checkIfDirty($key);
            }
            $keyClass = Inflector::getFullClassName($key);
            if (
                !$this->belongsTo($key)
                && in_array(static::getElementName(), $keyClass::getBelongsTo())
                && property_exists($this, $key . '_id')
                && !$keyClass::canOnlyBeNested()
            ) {
                return false;
            }

            return $this->$key->isDirty() || (!$keyClass::canOnlyBeNested() && $this->checkIfDirty($key . '_id'));
        } elseif (Inflector::isKnownElement(Inflector::classify($key)) && Inflector::isPluralClassName(Inflector::classify($key), $key)) {
            foreach ($this->$key as $value) {
                if ($value->isDirty()) {
                    return true;
                }
            }

            return false;
        }

        $keyPreged = preg_replace('/_id$/', '', $key);
        if (
            $keyPreged != $key
            && Inflector::isKnownElement($keyPreged)
            && isset($this->$keyPreged->id)
            && !empty($this->$keyPreged->id)
            && $this->$key != $this->$keyPreged->id
        ) {
            return true;
        }

        return $this->checkIfDirty($key);
    }

    public function checkIfDirty($key)
    {
        return is_null($this->_origValues)
            || (!property_exists($this->_origValues, $key) && !is_null($this->$key))
            || (isset($this->$key) && $this->$key != $this->_origValues->$key);
    }

    public function getElementBody($save = true)
    {
        // #TODO manage belongsTo and belongsToOptional
        foreach (static::getBelongsTo() as $parent) {
            if (!property_exists($this, $parent) || is_null($this->$parent)) {
                continue;
            }

            if (!$this->$parent->isPersisted()) {
                if (!in_array($parent, static::getAcceptedNestedElements()) && $save) {
                    $this->$parent->save();
                }
            } elseif ($this->$parent->isDirty() && $save) {
                $this->$parent->save();
            }

            if (property_exists($this->$parent, 'id') && !empty($this->$parent->id)) {
                $parentForeignKey = $parent . '_id';
                $this->$parentForeignKey = $this->$parent->id;
            }
        }

        $data = new \stdClass();
        foreach ($this->getApiAttributes() as $key => $value) {
            if ($key == '_origValues') continue;

            if (is_null($value) && $this->isKeyDirty($key)) {
                $data->$key = $value;
                continue;
            }

            $keyPreged = preg_replace('/_id$/', '', $key);
            $keyClass = Inflector::getFullClassName($key);

            if (
                $this->isKeyDirty($key)
                && (
                    !isset($this->{$key . '_id'})
                    || $keyClass::canOnlyBeNested()
                    || (
                        !$save
                        && $value->isDirty()
                    )
                )
                && (
                    $keyPreged == $key
                    || (
                        Inflector::isKnownElement($keyPreged)
                        && (property_exists($this, $keyPreged) || !is_null($this->$keyPreged))
                        && property_exists($this->$keyPreged, 'id')
                        && !empty($this->$keyPreged->id)
                    )
                )
            ) {
                $data->$key = self::getChildren($key, $value);
            }
        }

        if (
            !$this->isPersisted()
            || (
                !is_null($this->_origValues)
                && $this->id !== $this->_origValues->id
            )
            || (
                isset($data->id)
                && is_null($data->id)
            )
        ) {
            unset($data->id);
        }
        unset($data->_origValues);

        return $data;
    }

    private function getChildren($key, $value)
    {
        if (Inflector::isKnownElement($key)) { // If it is a element
            return $value->getElementBody();
        } elseif (Inflector::isKnownElement(Inflector::classify($key)) && Inflector::isPluralClassName(Inflector::classify($key), $key)) { // If it is an array of elements
            $arrayOfElements = [];

            foreach ($value as $k => $element) {
                $arrayOfElements[] = $element->getElementBody();
            }

            return $arrayOfElements;
        }

        return $value;
    }

    public static function newFromMixed($mixed)
    {
        $element = Inflector::constantize($mixed, Inflector::getClass(get_called_class()));
        foreach ($element as $key => $value) {
            if (is_object($value) && Inflector::isKnownElement($key)) {
                $class = get_class($value);
                $element->$key = $class::newFromMixed($value);
            }
        }
        $element->copyValues($element);
        return $element;
    }

    public function copyValues($object)
    {
        foreach ($object->getAllAttributes() as $key => $value) {
            if ($key != '_origValues') {
                if (is_object($value) && $value instanceof Element) {
                    $setter = 'set' . Inflector::classify($value::getElementName());
                    $value->copyValues($value);
                    $this->$setter($value);
                } elseif (is_array($value) && !empty($value) && $value[0] instanceof Element) {
                    $nestedElements = [];
                    foreach ($value as $key => $element) {
                        $element->copyValues($element);
                        $nestedElements[] = $element;
                    }
                    $this->$key = $nestedElements;
                } else {
                    $this->$key = $value;
                }
            }
        }

        unset($this->_origValues);
        $this->_origValues = clone $this;
    }

    public function isPersisted()
    {
        return (isset($this->_origValues) && isset($this->_origValues->id));
    }

    protected static function logCurrentClass($message)
    {
        $calledClassNameExploded = explode('\\', Inflector::getClass(get_called_class()));
        Logger::info(end($calledClassNameExploded) . ': ' . $message);
    }

    public function getOriginalValues()
    {
        return $this->_origValues;
    }

    public static function getReferenceAttribute() {
        return 'reference';
    }

    public function getReference() {
        $reference = $this->getReferenceAttribute();
        return $this->$reference;
    }

    public static function getElementName()
    {
        $className = Inflector::getClass(get_called_class());
        $explode = explode('\\', $className);
        return strtolower(end($explode));
    }

    public static function getAllElementKey()
    {
        return static::getElementName() . 's';
    }

    public static function canRetrieve()
    {
        return method_exists(Inflector::getClass(get_called_class()), 'retrieve');
    }

    public static function canCreate()
    {
        return method_exists(Inflector::getClass(get_called_class()), 'create');
    }

    public static function canDelete()
    {
        return method_exists(Inflector::getClass(get_called_class()), 'delete');
    }

    public static function canUpdate()
    {
        return method_exists(Inflector::getClass(get_called_class()), 'update');
    }

    public static function canGetAll()
    {
        return method_exists(Inflector::getClass(get_called_class()), 'all');
    }
}
