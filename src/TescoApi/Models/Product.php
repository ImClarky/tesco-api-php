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
}
