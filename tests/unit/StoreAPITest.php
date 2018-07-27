<?php

use PHPUnit\Framework\TestCase;
use ImClarky\TescoApi\Requests\StoreLocationRequest;
use ImClarky\TescoApi\Responses\AbstractResponse;
use ImClarky\TescoApi\Models\Store;
use ImClarky\TescoApi\Requests\Store\Filter;

class StoreAPITest extends TestCase
{
    private function getStoreResponse()
    {
        $request = new StoreLocationRequest('fca1666fa85a4b629a2c56533ea74395');
        $response = $request->send();
        // $response = $request->addFilter(Filter::FILTERABLE_CATEGORY, Store::CATEGORY_CFC)->send();

        return $response;
    }

    public function testStoreRequest()
    {
        $response = $this->getStoreResponse();

        $this->assertInstanceOf(AbstractResponse::class, $response);
    }

    public function testStoreRequestReturns200OK()
    {
        $response = $this->getStoreResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('OK', $response->getStatusMessage());
    }

    public function testStoreGeneratesModels()
    {
        $response = $this->getStoreResponse();

        var_dump($response->getModels()[0]->getOpeningTimes());

        $this->assertInstanceOf(Store::class, $response->getModels()[0]);
    }
}
