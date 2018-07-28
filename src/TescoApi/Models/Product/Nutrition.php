<?php

namespace ImClarky\TescoApi\Models\Product;

class Nutrition
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

    protected function setName(string $name): void
    {
        $this->_name = $name;
    }

    protected function setValuePer100(float $value): void
    {
        $this->_valuePer100 = $value;
    }

    protected function setValuePerServing(float $value): void
    {
        $this->_valuePerServing = $value;
    }
}
