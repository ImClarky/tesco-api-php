<?php

use PHPUnit\Framework\TestCase;
use ImClarky\TescoApi\Requests\ProductRequest;

class RequestTest extends TestCase
{
    public function testProductRequest()
    {
        $request = new ProductRequest('fca1666fa85a4b629a2c56533ea74395');
        $request->addGtin('05010204450513');

        $this->assertNotEmpty($request->send());
    }
}
