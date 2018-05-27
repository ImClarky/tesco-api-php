<?php

namespace ImClarky\TescoApi\Models;

class Product
{
    protected $_gtin;
    protected $_tpnb;
    protected $_tbnc;
    protected $_description;
    protected $_brand;
    protected $_quantity;
    protected $_totalQuantity;
    protected $_unitOfMesaure;
    protected $_netContents;
    protected $_averageMeasure;
    protected $_isFood;
    protected $_isDrink;
    protected $_isHazardous;
    protected $_storageType;
    protected $_isNonLiquidAnaglesic;
    protected $_containsLoperamide;
    protected $_width;
    protected $_height;
    protected $_depth;
    protected $_dimensionUnitOfMeasure;
    protected $_weight;
    protected $_weightUnitOfMeasure;
    protected $_volume;
    protected $_volumeUnitOfMeasure;
    protected $_gdas;
    protected $_nutrition;

    /**
     * Connstructor for new Product Information
     *
     * @param [type] $dataset Data from the API response
     */
    public function __construct($dataset)
    {

    }

    public function getGtinNumber()
    {
        return $this->_gtin;
    }

    public function getTpnbNumber()
    {
        return $this->_tpnb;
    }

    public function getTpncNumber()
    {
        return $this->_tpnc;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getBrand()
    {
        return $this->_brand;
    }

    public function getQuantity()
    {
        return $this->_quantity;
    }

    public function getTotalQuantity()
    {
        return $this->_totalQuantity;
    }

    public function getUnitOfMeasure()
    {
        return $this->_unitOfMesaure;
    }

    public function getNetContents()
    {
        return $this->_netContents;
    }

    public function getAverageMeasure()
    {
        return $this->_averageMeasure;
    }

    public function isFood()
    {
        return $this->_isFood;
    }

    public function isDrink()
    {
        return $this->_isDrink;
    }

    public function isHazardous()
    {
        return $this->_isHazardous;
    }

    public function isNonLiquidAnaglesic()
    {
        return $this->_isNonLiquidAnaglesic;
    }

    public function getStorageType()
    {
        return $this->_storageType;
    }

    public function containsLoperamide()
    {
        return $this->_containsLoperamide;
    }

    public function getWidth(bool $withUnits = true)
    {
        return $this->_width . ($withUnits ? $this->_dimensionUnitOfMeasure : '');
    }

    public function getHeight(bool $withUnits = true)
    {
        return $this->_height . ($withUnits ? $this->_dimensionUnitOfMeasure : '');
    }

    public function getDepth(bool $withUnits = true)
    {
        return $this->_depth . ($withUnits ? $this->_dimensionUnitOfMeasure : '');
    }

    public function getDimensionString()
    {
        return "W{$this->_width}xH{$this->_height}xD{$this->_depth}{$this->_dimensionUnitOfMeasure}";
    }

    public function getWeight(bool $withUnits = true)
    {
        return $this->_weight . ($withUnits ? $this->_weightUnitOfMeasure : '');
    }

    public function getVolume(bool $withUnits = true)
    {
        return $this->_volume . ($withUnits ? $this->_volumeUnitOfMeasure : '');
    }
}
