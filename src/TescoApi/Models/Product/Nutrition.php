<?php

namespace ImClarky\TescoApi\Models\Product;

/**
 * Product Nutrition Class
 */
class Nutrition
{
    /**
     * Nutrient Name
     *
     * @var string
     */
    protected $_name;

    /**
     * Nutrient Value per 100units
     *
     * @var float
     */
    protected $_valuePer100;

    /**
     * Nutrient Value per Serving
     *
     * @var float
     */
    protected $_valuePerServing;

    /**
     * Constructor
     *
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        $this->setName($dataset['name']);
        $this->setValuePer100((float) $dataset['valuePer100']);
        $this->setValuePerServing((float) $dataset['valuePerServing']);
    }

    /**
     * Set the Nutrient name
     *
     * @param string $name
     * @return void
     */
    protected function setName(string $name): void
    {
        $this->_name = $name;
    }

    /**
     * Set the Nutrient Value per 100units
     *
     * @param float $value
     * @return void
     */
    protected function setValuePer100(float $value): void
    {
        $this->_valuePer100 = $value;
    }

    /**
     * Set the Nutrient Value per Serving
     *
     * @param float $value
     * @return void
     */
    protected function setValuePerServing(float $value): void
    {
        $this->_valuePerServing = $value;
    }

    /**
     * Get the Nutrient Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Get the Nutrient value per 100 units
     *
     * @return float
     */
    public function getValuePer100(): float
    {
        return $this->_valuePer100;
    }

    /**
     * Get the Nutrient value per Serving
     *
     * @return float
     */
    public function getValuePerServing(): float
    {
        return $this->_valuePerServing;
    }
}
