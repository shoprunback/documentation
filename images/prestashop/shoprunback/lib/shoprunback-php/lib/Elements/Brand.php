<?php

namespace Shoprunback\Elements;

class Brand extends Element
{
    use Retrieve;
    use All;
    use Update;
    use Create;
    use Delete;

    public function __toString()
    {
        return $this->display($this->name);
    }

    public function getAllAttributes()
    {
        return get_object_vars($this);
    }

    public function getApiAttributesKeys()
    {
        return [
            'id',
            'name',
            'reference',
            'default',
            'created_at',
            'updated_at'
        ];
    }
}