<?php

namespace ImClarky\TescoApi;

use ImClarky\TescoApi\Requests\GroceryRequest;
use ImClarky\TescoApi\Requests\ProductRequest;
use ImClarky\TescoApi\Requests\StoreLocationRequest;

/**
 * Base Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class TescoApi
{
    /**
     * API Key
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_apiKey;

    /**
     * Create a new instance of the Base Class
     *
     * @param string $apiKey
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function __construct(string $apiKey)
    {
        $this->_apiKey = $apiKey;
    }

    /**
     * Get a new instance of a Grocery Request
     *
     * @return GroceryRequest
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function newGroceryRequest(): GroceryRequest
    {
        return new GroceryRequest($this->_apiKey);
    }

    /**
     * Get a new instance of a Product Request
     *
     * @return ProductRequest
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function newProductRequest(): ProductRequest
    {
        return new ProductRequest($this->_apiKey);
    }

    /**
     * Get a new instance of a Store Location Request
     *
     * @return StoreLocationRequest
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function newStoreLocationRequest(): StoreLocationRequest
    {
        return new StoreLocationRequest($this->_apiKey);
    }
}
