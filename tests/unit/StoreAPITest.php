<?php

use PHPUnit\Framework\TestCase;
use ImClarky\TescoApi\Responses\StoreLocationResponse;
use ImClarky\TescoApi\Models\Store;
use ImClarky\TescoApi\Models\Store\Facility;
use ImClarky\TescoApi\Models\Store\OpeningTime;
use ImClarky\TescoApi\Models\Store\OpeningTimeException;
use Dotenv\Dotenv;

class StoreAPITest extends TestCase
{
    protected $_response;
    protected $_model;
    protected $_apiKey;

    public function __construct()
    {
        $file = file_get_contents(__DIR__ . '/../data/storedata.txt');
        $this->_response = new StoreLocationResponse($file);
        $this->_model = $this->_response->getModels()[0];

        $dotenv = new Dotenv(dirname(dirname(__DIR__)));
        $dotenv->load();

        $this->_apiKey = $_ENV['TESCO_API'];

        parent::__construct();
    }

    public function testResponseClass()
    {
        $this->assertInstanceOf(StoreLocationResponse::class, $this->_response);
    }

    public function testModel()
    {
        $this->assertInstanceOf(Store::class, $this->_model);
    }

    public function testStoreId()
    {
        $this->assertEquals('af379b13-9b97-4b1c-b345-c1214a3e2f42', $this->_model->getId());
    }

    public function testStoreName()
    {
        $this->assertEquals('Lakeside Extra', $this->_model->getName());
    }

    public function testBranchNumber()
    {
        $this->assertEquals(2394, $this->_model->getBranchNumber());
    }

    public function testIsoCountryCode()
    {
        $this->assertEquals("GB", $this->_model->getIsoCountryCode());
    }

    public function testIsoSubdivision()
    {
        $this->assertEquals("ENG", $this->_model->getIsoSubdivision());
    }

    public function testAddressLine1()
    {
        $this->assertEquals("Cygnet View, Lakeside", $this->_model->getAddressLine1());
    }

    public function testAddressLine2()
    {
        $this->assertEquals("West Thurrock", $this->_model->getAddressLine2());
    }

    public function testAddressTown()
    {
        $this->assertEquals("Grays", $this->_model->getAddressTown());
    }

    public function testAddressPostcode()
    {
        $this->assertEquals("RM20 1TX", $this->_model->getAddressPostcode());
    }

    public function testFullAddress()
    {
        $string = "Cygnet View, Lakeside, West Thurrock, Grays, RM20 1TX";

        $this->assertEquals($string, $this->_model->getFullAddress());
    }

    public function testStoreType()
    {
        $this->assertEquals("Extra", $this->_model->getType());
        $this->assertTrue($this->_model->isType(Store::TYPE_EXTRA));
        $this->assertFalse($this->_model->isType(Store::TYPE_SUPERSTORE));
    }

    public function testStoreCategory()
    {
        $this->assertEquals("Store", $this->_model->getCategory());
        $this->assertTrue($this->_model->isCategory(Store::CATEGORY_STORE));
        $this->assertFalse($this->_model->isCategory(Store::CATEGORY_DISTRIBUTIONCENTRE));
    }

    public function testGeoCoordinates()
    {
        $this->assertEquals(0.27565, $this->_model->getLongitude());
        $this->assertEquals(51.48899, $this->_model->getLatitude());
        $this->assertEquals("51.48899, 0.27565", $this->_model->getGeoCoordinates());
    }

    public function testStoreStatus()
    {
        $this->assertEquals("Trading", $this->_model->getStatus());
    }

    public function testStoreDistance()
    {
        $this->assertEquals("2.5 Miles", $this->_model->getDistance());
    }

    public function testStoreFacilities()
    {
        $this->assertTrue(is_array($this->_model->getFacilities()));
        $this->assertCount(51, $this->_model->getFacilities());

        $this->assertTrue($this->_model->hasFacility(Facility::FACILITY_ATM));
        $this->assertFalse($this->_model->hasFacility(Facility::FACILITY_PAYQWIQ));
        $this->assertTrue(
            $this->_model->hasFacilities([
                Facility::FACILITY_ATM,
                Facility::FACILITY_COINSTAR
            ])
        );

        $this->assertInstanceOf(Facility::class, $this->_model->getFacility(Facility::FACILITY_ATM));
    }

    public function testOpeningTimes()
    {
        $this->assertTrue(is_array($this->_model->getOpeningTimes()));
        $this->assertInstanceOf(OpeningTime::class, $this->_model->getOpeningTimes()[0]);

        $this->assertTrue(is_array($this->_model->getOpeningTimeExceptions()));
        $this->assertInstanceOf(OpeningTimeException::class, $this->_model->getOpeningTimeExceptions()[0]);

        $exception = new DateTime('2017-12-25');
        $valid = new DateTime('2018-08-04');

        $this->assertTrue($this->_model->isOpenOn($valid));
        $this->assertFalse($this->_model->isOpenOn($exception));
    }
}
