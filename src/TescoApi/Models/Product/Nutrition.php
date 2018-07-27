<?php

namespace ImClarky\TescoApi\Models\Product;

use ImClarky\TescoApi\Models\AbstractModel as BaseModel;

class Nutrition extends BaseModel
{
    protected $_name;
    protected $_valuePer100;
    protected $_valuePerServing;

    public function __construct(array $dataset)
    {
        $this->setName($dataset['name']);
        $this->setValuePer100($dataset['valuePer100']);
        $this->setValuePerServing()($dataset['valuePerServing']);
    }

    protected function setName(string $name)
    {
        $this->_name = $name;
    }

    protected function setValuePer100(float $value)
    {
        $this->_valuePer100 = $value;
    }

    protected function setValuePerServing(float $value)
    {
        $this->_valuePerServing = $value;
    }
}
