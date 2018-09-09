<?php

namespace ImClarky\TescoApi\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use ImClarky\TescoApi\Requests\StoreLocationRequest;
use ImClarky\TescoApi\Responses\StoreLocationResponse;
use ImClarky\TescoApi\Tests\PHPUnitHelpers;
use ImClarky\TescoApi\Exceptions\RequestException;
use ImClarky\TescoApi\Models\Store;

class StoreAPITest extends TestCase
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
        $request = new StoreLocationRequest('');
    }

    public function testStoreLocationRequest()
    {
        $request = new StoreLocationRequest(getenv('TESCO_API'));
        $this->assertInstanceOf(StoreLocationRequest::class, $request);
        $this->assertInternalType('resource', PHPUnitHelpers::getPropertyAsPublic($request, '_curl'));
        $this->assertEquals(getenv('TESCO_API'), PHPUnitHelpers::getPropertyAsPublic($request, '_apiKey'));

        return $request;
    }

    /**
     * @depends testStoreLocationRequest
     */
    public function testSendRequest($request)
    {
        $response = $request->send();
        $this->assertInstanceOf(StoreLocationResponse::class, $response);

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
        $this->assertEquals("?limit=10&offset=0", $queryString);
    }

    /**
     * @depends testStoreLocationRequest
     */
    public function testFullRequestUri($request)
    {
        PHPUnitHelpers::callMethodAsPublic($request, 'buildQueryString');

        $requestUri = PHPUnitHelpers::callMethodAsPublic($request, 'getRequestUri');

        $this->assertEquals("https://dev.tescolabs.com/locations/search?limit=10&offset=0", $requestUri);
    }

    /**
     * @depends testSendRequest
     */
    public function testResponseModels($response)
    {
        $models = $response->getModels();

        $this->assertInternalType('array', $models);
        $this->assertInstanceOf(Store::class, $models[0]);
    }
}
