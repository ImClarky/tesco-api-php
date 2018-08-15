<?php

namespace ImClarky\TescoApi\Models;

use ImClarky\TescoApi\Models\AbstractModel;

/**
 * Grocery Model Class
 */
class Grocery extends AbstractModel
{
    /**
     * Grocery ID
     *
     * @var int
     */
    protected $_id;

    /**
     * Grocery name
     *
     * @var string
     */
    protected $_name;

    /**
     * Grocery Description
     *
     * @var array
     */
    protected $_description;

    /**
     * Grocery's Tesco Product Number Base (TPNB) number
     *
     * @var string
     */
    protected $_tpnb;

    /**
     * Grocery Image URL
     *
     * @var string
     */
    protected $_image;

    /**
     * Grocery Department
     *
     * @var string
     */
    protected $_department;

    /**
     * Grocery Super Department
     *
     * @var string
     */
    protected $_superDepartment;

    /**
     * Grocery Price
     *
     * @var float
     */
    protected $_price;

    /**
     * Grocery Unit Price
     * Eg 1.20 per KG
     *
     * @var float
     */
    protected $_unitPrice;

    /**
     * Grocery Unit Quantity
     *
     * @var string
     */
    protected $_unitQuantity;

    /**
     * Grocery Contents Quantity
     *
     * @var int
     */
    protected $_contentsQuantity;

    /**
     * Grocery Contents Unit of Measure
     *
     * @var string
     */
    protected $_contentsUnitOfMeasure;

    /**
     * Grocery Average Unit Weight
     *
     * @var float
     */
    protected $_averageUnitWeight;

    /**
     * Grocery Unit of Sale
     *
     * @var int
     */
    protected $_unitOfSale;

    /**
     * @inheritDoc
     *
     * @var array
     */
    protected $_dataMap = [
        'id' => 'id',
        'name' => 'name',
        'description' => 'description',
        'tpnb' => 'tpnb',
        'image' => 'image',
        'department' => 'department',
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
     * Grocery Constructor
     *
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        parent::__construct($dataset);
    }

    /**
     * Get the Grocery ID
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * Get the Grocery Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Get the Grocery Description
     *
     * @return array
     */
    public function getDescription(): array
    {
        return $this->_description;
    }

    /**
     * Get the Grocery TPNB number
     *
     * @return string
     */
    public function getTpnbNumber(): string
    {
        return $this->_tpnb;
    }

    /**
     * Get the Grocery Image URL
     *
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->_image;
    }

    /**
     * Get the Grocery Department
     *
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->_department;
    }

    /**
     * Get the Grocery Super Department
     *
     * @return string
     */
    public function getSuperDepartment(): string
    {
        return $this->_superDepartment;
    }

    /**
     * Get the Grocery Price
     *
     * @return string
     */
    public function getPrice(): float
    {
        return $this->_price;
    }

    /**
     * Get the Grocery Unit Price
     *
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->_unitPrice;
    }

    /**
     * Get the Grocery Unit Quantity
     *
     * @return string
     */
    public function getUnitQuantity(): string
    {
        return $this->_unitQuantity;
    }

    /**
     * Get the Grocery Unit of Sale
     *
     * @return integer
     */
    public function getUnitOfSale(): int
    {
        return $this->_unitOfSale;
    }

    /**
     * Get the Grocery Contents Quantity
     *
     * @return integer
     */
    public function getContentsQuantity(): int
    {
        return $this->_contentsQuantity;
    }

    /**
     * Get the Grocery Contents Unit of Measure
     *
     * @return string
     */
    public function getContentsUnitOfMeasure(): string
    {
        return $this->_contentsUnitOfMeasure;
    }

    /**
     * Get the Grocery Average Unit Weight
     *
     * @return float
     */
    public function getAverageUnitWeight(): float
    {
        return $this->_averageUnitWeight;
    }
}
