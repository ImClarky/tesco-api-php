<?php

namespace ImClarky\TescoApi;

use ImClarky\TescoApi\Requests\GroceryRequest;
use ImClarky\TescoApi\Requests\ProductRequest;
use ImClarky\TescoApi\Requests\StoreLocationRequest;

class TescoApi
{
    protected $_apiKey;

    public function __construct(string $apiKey)
    {
        $this->_apiKey = $apiKey;
    }

    public function newGroceryRequest()
    {
        return new GroceryRequest($this->_apiKey);
    }

    public function newProductRequest()
    {
        return new ProductRequest($this->_apiKey);
    }

    public function newStoreLocationRequest()
    {
        return new StoreLocationRequest($this->_apiKey);
    }
}
