<?php

namespace Shoprunback\Elements;

class Product extends Element
{
    use Retrieve;
    use All;
    use Update;
    use Create;
    use Delete;

    private $brand;

    public function __toString()
    {
        return $this->display($this->label);
    }

    public static function getBelongsTo()
    {
        return ['brand'];
    }

    public static function getAcceptedNestedElements()
    {
        return ['brand'];
    }

    public function getAllAttributes()
    {
        return get_object_vars($this);
    }

    public function getApiAttributesKeys()
    {
        return [
            'id',
            'label',
            'reference',
            'ean',
            'weight_grams',
            'width_mm',
            'length_mm',
            'height_mm',
            'brand_id',
            'brand',
            'picture_file_base64',
            'picture_file_url',
            'created_at',
            'updated_at',
            'picture_url',
            'metadata'
        ];
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getBrand()
    {
        return $this->brand;
    }
}