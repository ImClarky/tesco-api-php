<?php

// use PHPUnit\Framework\TestCase;
// use ImClarky\TescoApi\Requests\ProductRequest;
// use ImClarky\TescoApi\Responses\AbstractResponse;
// use ImClarky\TescoApi\Models\Product;

// class ProductAPITest extends TestCase
// {
//     private function getProductResponse()
//     {
//         $request = new ProductRequest('fca1666fa85a4b629a2c56533ea74395');
//         $response = $request->addGtin('05010204450513')->send();

//         return $response;
//     }

//     public function testProductRequest()
//     {
//         $response = $this->getProductResponse();

//         $this->assertInstanceOf(AbstractResponse::class, $response);
//     }

//     public function testProductRequestReturns200OK()
//     {
//         $response = $this->getProductResponse();

//         $this->assertEquals(200, $response->getStatusCode());
//         $this->assertEquals('OK', $response->getStatusMessage());
//     }

//     public function testResponseGeneratesModels()
//     {
//         $response = $this->getProductResponse();

//         $this->assertInstanceOf(Product::class, $response->getModels()[0]);
//     }

//     public function testProductModelIsFood()
//     {
//         $response = $this->getProductResponse();
//         $model = $response->getModels()[0];

//         $this->assertEquals(true, $model->isFood());
//     }
// }
