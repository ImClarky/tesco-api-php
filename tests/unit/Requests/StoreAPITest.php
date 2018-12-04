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
use ImClarky\TescoApi\Requests\Store\Sort;

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

    public function testAddingLike()
    {
        $request = new StoreLocationRequest(getenv('TESCO_API'));

        $request->addLike(Like::FILTER_BRANCHNUMBER, '1234');
        $request->addLike(Like::FILTER_CATEGORY, Store::CATEGORY_STORE);
        $request->addLike(Like::FILTER_TYPE, Store::TYPE_EXTRA);
        $request->addLike(Like::FILTER_FACILITY, Facility::FACILITY_ATM);
        $request->addLike(Like::FILTER_ISOCOUNTRYCODE, 'gb');
        $request->addLike(Like::FILTER_NAME, ['Lakeside', 'Hackney'], true);
        $request->addLike(Like::FILTER_STATUS, 'Trading');

        $request->addLike(Like::FILTER_FACILITY, Facility::FACILITY_CAFE);

        $expectedFiltersArray = [
            'branchNumber' => ['1234'],
            'category' => ['Store'],
            'type' => ['Extra'],
            'facilities' => ['ATM', 'CAFE'],
            'isoCountryCode' => ['gb'],
            'name' => [['^Lakeside', '^Hackney']],
            'status' => ['Trading'],
        ];

        $expectedFiltersString = "branchNumber%3A1234%20AND%20category%3AStore%20AND%20type%3AExtra%20AND%20facilities%3AATM%20AND%20facilities%3ACAFE%20AND%20isoCountryCode%3Agb%20AND%20name%3A%5ELakeside%2C%5EHackney%20AND%20status%3ATrading";

        $like = PHPUnitHelpers::getPropertyAsPublic($request, '_like');

        $this->assertInstanceOf(Like::class, $like);
        $this->assertEquals($expectedFiltersArray, PHPUnitHelpers::getPropertyAsPublic($like, '_filters'));
        $this->assertEquals($expectedFiltersString, PHPUnitHelpers::callMethodAsPublic($like, 'buildQuerySegment'));

        $this->assertInstanceOf(StoreLocationResponse::class, $request->send());
    }

    public function testAddingFilter()
    {
        $request = new StoreLocationRequest(getenv('TESCO_API'));

        $request->addFilter(Filter::FILTER_BRANCHNUMBER, '2394');
        $request->addFilter(Filter::FILTER_CATEGORY, Store::CATEGORY_STORE);
        $request->addFilter(Filter::FILTER_TYPE, Store::TYPE_EXTRA);
        $request->addFilter(Filter::FILTER_FACILITY, Facility::FACILITY_ATM);
        $request->addFilter(Filter::FILTER_ISOCOUNTRYCODE, 'gb');
        $request->addFilter(Filter::FILTER_NAME, 'Lakeside Extra');
        $request->addFilter(Filter::FILTER_STATUS, 'Trading');

        $request->addFilter(Filter::FILTER_FACILITY, Facility::FACILITY_CAFE);

        $expectedFiltersArray = [
            'branchNumber' => ['2394'],
            'category' => ['Store'],
            'type' => ['Extra'],
            'facilities' => ['ATM', 'CAFE'],
            'isoCountryCode' => ['gb'],
            'name' => ['Lakeside Extra'],
            'status' => ['Trading'],
        ];

        $expectedQueryString = "branchNumber%3A2394%20AND%20category%3AStore%20AND%20type%3AExtra%20AND%20facilities%3AATM%20AND%20facilities%3ACAFE%20AND%20isoCountryCode%3Agb%20AND%20name%3A%22Lakeside%20Extra%22%20AND%20status%3ATrading";

        $filter = PHPUnitHelpers::getPropertyAsPublic($request, "_filter");

        $this->assertInstanceOf(Filter::class, $filter);
        $this->assertEquals($expectedFiltersArray, PHPUnitHelpers::getPropertyAsPublic($filter, '_filters'));
        $this->assertEquals($expectedQueryString, PHPUnitHelpers::callMethodAsPublic($filter, 'buildQuerySegment'));

        $this->assertInstanceOf(StoreLocationResponse::class, $request->send());
    }

    public function testAddingSort()
    {
        $request = new StoreLocationRequest(getenv('TESCO_API'));

        $request->addSort(Sort::SORT_NEAR, 'SE11 5AP');

        $expectedSortArray = [
            'near' => ['SE11 5AP']
        ];

        $expectedQueryString = 'near%3A%22SE11%205AP%22';

        $sort = PHPUnitHelpers::getPropertyAsPublic($request, "_sort");

        $this->assertInstanceOf(Sort::class, $sort);
        $this->assertEquals($expectedSortArray, PHPUnitHelpers::getPropertyAsPublic($sort, '_filters'));
        $this->assertEquals($expectedQueryString, PHPUnitHelpers::callMethodAsPublic($sort, 'buildQuerySegment'));

        $this->assertInstanceOf(StoreLocationResponse::class, $request->send());
    }
}
