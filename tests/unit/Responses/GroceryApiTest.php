<?php

use PHPUnit\Framework\TestCase;
use ImClarky\TescoApi\Responses\GroceryResponse;
use ImClarky\TescoApi\Models\Grocery;

class GroceryAPITest extends TestCase
{
    protected $_response;
    protected $_model;

    public function __construct()
    {
        $file = file_get_contents(__DIR__ . '/../../data/grocerydata.txt');
        $this->_response = new GroceryResponse($file);
        $this->_model = $this->_response->getModels()[0];

        parent::__construct();
    }

    public function testResponseClass()
    {
        $this->assertInstanceOf(GroceryResponse::class, $this->_response);
    }

    public function testModel()
    {
        $this->assertInstanceOf(Grocery::class, $this->_model);
    }

    public function testGetId()
    {
        $this->assertEquals(285383766, $this->_model->getId());
    }

    public function testGetName()
    {
        $this->assertEquals('Cadbury Dairy Milk Giant Buttons 119G', $this->_model->getName());
    }

    public function testGetDescription()
    {
        $this->assertTrue(is_array($this->_model->getDescription()));
    }

    public function testGetTpnbNumber()
    {
        $this->assertEquals('56808958', $this->_model->getTpnbNumber());
    }

    public function testGetImageUrl()
    {
        $this->assertEquals('http://img.tesco.com/Groceries/pi/956/7622210286956/IDShot_90x90.jpg', $this->_model->getImageUrl());
    }

    public function testGetDepartment()
    {
        $this->assertEquals('Chocolate', $this->_model->getDepartment());
    }

    public function testGetSuperDepartment()
    {
        $this->assertEquals('Food Cupboard', $this->_model->getSuperDepartment());
    }

    public function testGetPrice()
    {
        $this->assertEquals(1.5, $this->_model->getPrice());
    }

    public function testGetUnitPrice()
    {
        $this->assertEquals(1.27, $this->_model->getUnitPrice());
    }

    public function testGetUnitQuantity()
    {
        $this->assertEquals('100G', $this->_model->getUnitQuantity());
    }

    public function testGetUnitOfSale()
    {
        $this->assertEquals(1, $this->_model->getUnitOfSale());
    }

    public function testGetContentsQuantity()
    {
        $this->assertEquals(119, $this->_model->getContentsQuantity());
    }

    public function testGetContentsUnitOfMeasure()
    {
        $this->assertEquals('G', $this->_model->getContentsUnitOfMeasure());
    }

    public function testGetAverageUnitWeight()
    {
        $this->assertEquals(0.183, $this->_model->getAverageUnitWeight());
    }
}
