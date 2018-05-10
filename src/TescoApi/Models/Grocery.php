<?php

namespace ImClarky\TescoApi\Models;

class Grocery
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

    /**
     * Undocumented function
     *
     * @param [type] $dataset
     */
    public function __construct($dataset)
    {

    }
}
