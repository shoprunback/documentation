<?php

namespace Shoprunback\Elements;

class Shipback extends Element
{
    use Retrieve;
    use All;
    use Create;
    use Update;
    use Delete;

    private $order;
    private $customer;
    private $company;

    public function __toString()
    {
        return $this->display($this->id);
    }

    public static function getBelongsTo()
    {
        return ['order'];
    }

    public static function getAcceptedNestedElements()
    {
        return ['returnedItems', 'customer', 'company'];
    }

    public function getAllAttributes()
    {
        return get_object_vars($this);
    }

    public static function getReferenceAttribute()
    {
        return 'id';
    }

    public function getApiAttributesKeys()
    {
        return [
            'id',
            'rma',
            'mode',
            'weight_in_grams',
            'computed_weight_in_grams',
            'created_at',
            'public_url',
            'returned_items',
            'metadata',
            'order_id',
            'order',
            'company_id',
            'company',
            'customer',
            'size',
            'quotes'
        ];
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function getCompany()
    {
        return $this->company;
    }
}