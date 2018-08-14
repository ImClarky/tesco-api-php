<?php

use PHPUnit\Framework\TestCase;
use ImClarky\TescoApi\Responses\ProductResponse;
use ImClarky\TescoApi\Models\Product;

class ProductAPITest extends TestCase
{
    protected $_response;
    protected $_model;

    public function __construct()
    {
        $file = file_get_contents(__DIR__ . '/../data/productdata.txt');
        $this->_response = new ProductResponse($file);
        $this->_model = $this->_response->getModels()[0];

        parent::__construct();
    }

    public function testResponseClass()
    {
        $this->assertInstanceOf(ProductResponse::class, $this->_response);
    }

    public function testModel()
    {
        $this->assertInstanceOf(Product::class, $this->_model);
    }

    public function testGetGtinNumber()
    {
        $this->assertEquals('05052910081995', $this->_model->getGtinNumber());
    }

    public function testGetTpnbNumber()
    {
        $this->assertEquals('051703744', $this->_model->getTpnbNumber());
    }

    public function testGetTpncNumber()
    {
        $this->assertEquals('275152404', $this->_model->getTpncNumber());
    }

    public function testGetDescription()
    {
        $this->assertEquals('Tesco Spaghetti Bolognese 450G', $this->_model->getDescription());
    }

    public function testGetBrand()
    {
        $this->assertEquals('TESCO', $this->_model->getBrand());
    }

    public function testGetQuantity()
    {
        $this->assertEquals(450, $this->_model->getQuantity());
    }

    public function testGetTotalQuantity()
    {
        $this->assertEquals(450, $this->_model->getTotalQuantity());
    }

    public function testGetUnitOfMeasure()
    {
        $this->assertEquals('g', $this->_model->getUnitOfMeasure());
    }

    public function testGetNetContents()
    {
        $this->assertEquals('450g e', $this->_model->getNetContents());
    }

    public function testGetAverageMeasure()
    {
        $this->assertNull($this->_model->getAverageMeasure());
    }

    public function testIsFood()
    {
        $this->assertTrue($this->_model->isFood());
    }

    public function testIsDrink()
    {
        $this->assertFalse($this->_model->isDrink());
    }

    public function testIsHazardous()
    {
        $this->assertFalse($this->_model->isHazardous());
    }

    public function testIsNonLiquidAnalgesic()
    {
        $this->assertFalse($this->_model->isNonLiquidAnalgesic());
    }

    public function testContainsLoperamide()
    {
        $this->assertFalse($this->_model->containsLoperamide());
    }

    public function testGetStorageType()
    {
        $this->assertEquals('Chilled', $this->_model->getStorageType());
    }

    public function testDimensions()
    {
        $this->assertEquals(15, $this->_model->getWidth());
        $this->assertEquals(5.6, $this->_model->getHeight());
        $this->assertEquals(12.6, $this->_model->getDepth());

        $this->assertEquals('cm', $this->_model->getDimensionMeasurement());

        $this->assertEquals('15cm', $this->_model->getWidthWithMeasurement());
        $this->assertEquals('5.6cm', $this->_model->getHeightWithMeasurement());
        $this->assertEquals('12.6cm', $this->_model->getDepthWithMeasurement());

        $this->assertEquals('W15xH5.6xD12.6cm', $this->_model->getDimensionsString());
    }

    public function testWeight()
    {
        $this->assertEquals(488, $this->_model->getWeight());
        $this->assertEquals('g', $this->_model->getWeightMeasurement());
        $this->assertEquals('488g', $this->_model->getWeightWithMeasurement());
    }

    public function testVolume()
    {
        $this->assertEquals(1058.4, $this->_model->getVolume());
        $this->assertEquals('cc', $this->_model->getVolumeMeasurement());
        $this->assertEquals('1058.4cc', $this->_model->getVolumeWithMeasurement());
    }
}
