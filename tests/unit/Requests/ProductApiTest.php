<?php

namespace ImClarky\TescoApi\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use ImClarky\TescoApi\Requests\ProductRequest;
use ImClarky\TescoApi\Responses\ProductResponse;
use ImClarky\TescoApi\Exceptions\RequestException;
use ImClarky\TescoApi\Models\Product;
use ImClarky\TescoApi\Tests\PHPUnitHelpers;

class ProductAPITest extends TestCase
{
    public static function setUpBeforeClass()
    {
        $directory = dirname(__DIR__, 3);

        if (file_exists($directory . '/.env')) {
            $dotenv = new Dotenv($directory);
            $dotenv->load();
        }
    }

    public function testNoApiKeyException()
    {
        $this->expectException(RequestException::class);
        $request = new ProductRequest('');
    }

    public function testStoreLocationRequest()
    {
        $request = new ProductRequest(getenv('TESCO_API'));
        $this->assertInstanceOf(ProductRequest::class, $request);
        $this->assertInternalType('resource', PHPUnitHelpers::getPropertyAsPublic($request, '_curl'));
        $this->assertEquals(getenv('TESCO_API'), PHPUnitHelpers::getPropertyAsPublic($request, '_apiKey'));

        return $request;
    }

    /**
     * @depends testStoreLocationRequest
     */
    public function testSendRequest($request)
    {
        $response = $request
            ->addGtin('05052910081995')
            ->addTpnb('051442919')
            ->addTpnc('275456460')
            ->addCatId('785-7791')
            ->send();
        $this->assertInstanceOf(ProductResponse::class, $response);

        return $response;
    }

    /**
     * @depends testSendRequest
     */
    public function test200OK($response)
    {
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @depends testSendRequest
     */
    public function testOKMessage($response)
    {
        $this->assertEquals("OK", $response->getStatusMessage());
    }

    /**
     * @depends testStoreLocationRequest
     */
    public function testBuildQueryString($request)
    {
        PHPUnitHelpers::callMethodAsPublic($request, 'buildQueryString');

        $queryString = PHPUnitHelpers::getPropertyAsPublic($request, '_queryString');
        $this->assertEquals("?gtin=05052910081995&tpnb=051442919&tpnc=275456460&catid=785-7791", $queryString);
    }

    /**
     * @depends testStoreLocationRequest
     */
    public function testFullRequestUri($request)
    {
        PHPUnitHelpers::callMethodAsPublic($request, 'buildQueryString');

        $requestUri = PHPUnitHelpers::callMethodAsPublic($request, 'getRequestUri');

        $this->assertEquals("https://dev.tescolabs.com/product?gtin=05052910081995&tpnb=051442919&tpnc=275456460&catid=785-7791", $requestUri);
    }

    /**
     * @depends testSendRequest
     */
    public function testResponseModels($response)
    {
        $models = $response->getModels();

        $this->assertInternalType('array', $models);
        $this->assertInstanceOf(Product::class, $models[0]);
    }
}
