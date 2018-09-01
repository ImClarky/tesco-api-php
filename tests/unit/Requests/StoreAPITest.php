<?php

namespace ImClarky\TescoApi\Tests\Requests;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use ImClarky\TescoApi\Requests\StoreLocationRequest;
use ImClarky\TescoApi\Responses\StoreLocationResponse;
use ImClarky\TescoApi\Tests\PHPUnitHelpers;

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

    public function testStoreLocationRequest()
    {
        $request = new StoreLocationRequest($_ENV['TESCO_API']);
        $this->assertInstanceOf(StoreLocationRequest::class, $request);

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
}
