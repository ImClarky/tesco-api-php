<?php

namespace ImClarky\TescoApi\Models;

use ImClarky\TescoApi\Models\AbstractModel as BaseModel;

class Grocery extends BaseModel
{
    protected $_id;
    protected $_name;
    protected $_description;
    protected $_tpnb;
    protected $_image;
    protected $_department;
    protected $_superDepartment;
    protected $_price;
    protected $_unitPrice;
    protected $_unitQuantity;
    protected $_contentsQuantity;
    protected $_contentsUnitOfMeasure;
    protected $_averageUnitWeight;
    protected $_unitOfSale;

    protected $_dataMap = [
        'id' => 'id',
        'name' => 'name',
        'description' => 'setDescription',
        'tpnb' => 'tpnb',
        'image' => 'image',
        'superDepartment' => 'superDepartment',
        'price' => 'price',
        'unitprice' => 'unitPrice',
        'UnitQuantity' => 'unitQuantity',
        'ContentsQuantity' => 'contentsQuantity',
        'ContentsMeasureType' => 'contentsUnitOfMeasure',
        'AverageSellingUnitWeight' => 'averageUnitWeight',
        'UnitOfSale' => 'unitOfSale'
    ];

    /**
     * Undocumented function
     *
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        parent::__construct($dataset);
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getTpnbNumber()
    {
        return $this->_tpnb;
    }

    public function getImageUrl()
    {
        return $this->_image;
    }

    public function getDepartment()
    {
        return $this->_department;
    }

    public function getSuperDepartment()
    {
        return $this->_superDepartment;
    }

    public function getPrice(bool $withCurrency = true)
    {
        return ($withCurrency ? "£" : '') . $this->_price;
    }

    public function getUnitPrice(bool $withCurrency = true)
    {
        return ($withCurrency ? "£" : '') . $this->_unitPrice;
    }

    public function getUnitQuantity()
    {
        return $this->_unitQuantity;
    }

    public function getUnitOfSale()
    {
        return $this->_unitOfSale;
    }

    public function getContentsQuantity()
    {
        return $this->_contentsQuantity;
    }

    public function getContentsUnitOfMeasure()
    {
        return $this->_contentsUnitOfMeasure;
    }

    public function getAverageUnitWeight()
    {
        return $this->_averageUnitWeight;
    }
}
