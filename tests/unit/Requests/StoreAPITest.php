<?php

namespace ImClarky\TescoApi\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use ImClarky\TescoApi\Requests\StoreLocationRequest;
use ImClarky\TescoApi\Responses\StoreLocationResponse;
use ImClarky\TescoApi\Tests\PHPUnitHelpers;
use ImClarky\TescoApi\Exceptions\RequestException;
use ImClarky\TescoApi\Models\Store;
use ImClarky\TescoApi\Requests\Store\Like;
use ImClarky\TescoApi\Models\Store\Facility;
use ImClarky\TescoApi\Requests\Store\Filter;

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

    /**
     * @depends testStoreLocationRequest
     */
    public function testAddingLike($request)
    {
        $request->addLike(Like::FILTER_BRANCHNUMBER, '1234');
        $request->addLike(Like::FILTER_CATEGORY, Store::CATEGORY_STORE);
        $request->addLike(Like::FILTER_TYPE, Store::TYPE_EXTRA);
        $request->addLike(Like::FILTER_FACILITY, Facility::FACILITY_ATM);
        $request->addLike(Like::FILTER_ISOCOUNTRYCODE, 'gb');
        $request->addLike(Like::FILTER_NAME, ['Lakeside', 'Hackney'], true);
        $request->addLike(Like::FILTER_STATUS, 'Trading');

        $expectedFiltersArray = [
            'branchNumber' => ['1234'],
            'category' => ['Store'],
            'type' => ['Extra'],
            'facilities' => ['ATM'],
            'isoCountryCode' => ['gb'],
            'name' => [['^Lakeside', '^Hackney']],
            'status' => ['Trading'],
        ];

        $expectedFiltersString = "branchNumber:1234 AND category:Store AND type:Extra AND facilities:ATM AND isoCountryCode:gb AND name:^Lakeside,^Hackney AND status:Trading";

        $like = PHPUnitHelpers::getPropertyAsPublic($request, '_like');

        $this->assertInstanceOf(Like::class, $like);
        $this->assertEquals($expectedFiltersArray, PHPUnitHelpers::getPropertyAsPublic($like, '_filters'));
        $this->assertEquals($expectedFiltersString, PHPUnitHelpers::callMethodAsPublic($like, 'buildQuerySegment'));
    }

    /**
     * @depends testStoreLocationRequest
     */
    public function testAddingFilter($request)
    {
        $request->addFilter(Filter::FILTER_BRANCHNUMBER, '1234');
        $request->addFilter(Filter::FILTER_CATEGORY, Store::CATEGORY_STORE);
        $request->addFilter(Filter::FILTER_TYPE, Store::TYPE_EXTRA);
        $request->addFilter(Filter::FILTER_FACILITY, Facility::FACILITY_ATM);
        $request->addFilter(Filter::FILTER_ISOCOUNTRYCODE, 'gb');
        $request->addFilter(Filter::FILTER_NAME, 'Lakeside');
        $request->addFilter(Filter::FILTER_STATUS, 'Trading');
    }
}
