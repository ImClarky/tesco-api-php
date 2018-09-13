<?php

namespace ImClarky\TescoApi\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use ImClarky\TescoApi\Requests\GroceryRequest;
use ImClarky\TescoApi\Requests\StoreLocationRequest;
use ImClarky\TescoApi\Requests\ProductRequest;
use ImClarky\TescoApi\TescoApi;
use ImClarky\TescoApi\Tests\PHPUnitHelpers;

class BaseClassTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        $directory = dirname(__DIR__, 3);

        if (file_exists($directory . '/.env')) {
            $dotenv = new Dotenv($directory);
            $dotenv->load();
        }
    }

    public function testInstantiation()
    {
        $instance = new TescoApi(getenv('TESCO_API'));
        $this->assertInstanceOf(TescoApi::class, $instance);
        $this->assertEquals(getenv('TESCO_API'), PHPUnitHelpers::getPropertyAsPublic($instance, '_apiKey'));

        return $instance;
    }

    /**
     * @depends testInstantiation
     */
    public function testGroceryRequest($instance)
    {
        $request = $instance->newGroceryRequest();
        $this->assertInstanceOf(GroceryRequest::class, $request);
    }

    /**
     * @depends testInstantiation
     */
    public function testStoreLocationRequest($instance)
    {
        $request = $instance->newStoreLocationRequest();
        $this->assertInstanceOf(StoreLocationRequest::class, $request);
    }

    /**
     * @depends testInstantiation
     */
    public function testProductRequest($instance)
    {
        $request = $instance->newProductRequest();
        $this->assertInstanceOf(ProductRequest::class, $request);
    }
}
