<?php

namespace Shoprunback\Util;

use Shoprunback\Util\Container;
use Shoprunback\Error\UnknownElement;

abstract class Inflector
{
    const ELEMENTS_NAMESPACE = 'Shoprunback\Elements\\';

    public static function classify($string)
    {
        if (substr($string, -3) == 'ies') {
            return rtrim(ucfirst($string), 'ies') . 'y';
        } elseif (substr($string, -2) != 'ss') {
            return rtrim(ucfirst($string), 's');
        }

        return $string;
    }

    private static function removeNamespaceFromString($string)
    {
        return str_replace(self::ELEMENTS_NAMESPACE, '', $string);
    }

    public static function getFullClassName($string)
    {
        return self::ELEMENTS_NAMESPACE . self::classify(self::removeNamespaceFromString($string));
    }

    public static function pluralize($className)
    {
        if (substr($className, -1) == 'y') {
            return strtolower(rtrim($className, 'y') . 'ies');
        } else if (substr($className, -2) == 'ss') {
            return strtolower($className . 'es');
        } else if (substr($className, -1) == 's') {
            return strtolower($className);
        } else {
            return strtolower($className . 's');
        }
    }

    public static function isPluralClassName($className, $string) {
        return self::pluralize($className) == $string;
    }

    public static function isKnownElement($className) {
        return class_exists(self::ELEMENTS_NAMESPACE . self::removeNamespaceFromString($className));
    }

    public static function constantize($mixed, $inflectedClassName)
    {
        $inflectedClassName = self::ELEMENTS_NAMESPACE . str_replace(self::ELEMENTS_NAMESPACE, '', $inflectedClassName);
        $object = new $inflectedClassName();

        foreach ($mixed as $key => $value) {
            if ($key == '_origValues') continue;

            $content = self::getContent($key, $value);
            if (is_object($content) && $content instanceof Element) {
                $class = self::classify($content::getElementName());
                $setter = 'set' . $class;
                $object->$setter($content);
            } else {
                $object->$key = $content;
            }
        }

        return $object;
    }

    private static function inflectContainer($container)
    {
        $inflectedContainer = !is_array($container) ? new \StdClass() : [];

        foreach ($container as $key => $value) {
            Container::addValueToContainer($inflectedContainer, $key, self::getContent($key, $value));
        }

        return $inflectedContainer;
    }

    private static function searchElementInContainer($container)
    {
        if (Container::isContainer($container)) {
            return self::inflectContainer($container);
        }

        return $container;
    }

    private static function getContent($key, $value)
    {
        $className = self::classify($key);

        $valueToAdd = [];

        if (self::isKnownElement($className) && self::isPluralClassName($className, $key)) {
            foreach ($value as $k => $v) {
                $valueToAdd[] = self::constantize($v, $className);
            }
        } else {
            $valueToAdd = self::isKnownElement($className)
                ? self::constantize($value, $className)
                : self::searchElementInContainer($value);
        }

        return $valueToAdd;
    }

    public static function getClass($class)
    {
        if (is_object($class)) {
            // Check if the object is a child (direct or not) of Element to use getElementName
            // Then it checks if it is a direct child of Element
            if (is_a($class, self::ELEMENTS_NAMESPACE . 'Element') && self::isKnownElement(get_class($class))) {
                return get_class($class);
            }

            // Check if it has a parent class which is not abstract
            if ($parentClass = get_parent_class($class)) {
                try {
                    $className = static::getClass($parentClass);
                    return $className;
                } catch (UnknownElement $e) {
                    return $e;
                }
            }

            throw new UnknownElement('Unknown element ' . get_class($class));
        }

        if (self::isKnownElement($class)) {
            return self::getFullClassName($class);
        }

        // FALSE checks if the class is not abstract so we can instantiate it
        if (class_exists($class, FALSE)) {
            $object = new \ReflectionClass($class);
            if ($object->getParentClass()) {
                try {
                    $className = static::getClass($object->getParentClass()->getName());
                    return $className;
                } catch (UnknownElement $e) {
                    return $e;
                }
            }
        }

        throw new UnknownElement('Unknown element ' . $class);
    }
}