<?php

namespace ImClarky\TescoApi\Responses;

use ImClarky\TescoApi\Responses\AbstractResponse;
use ImClarky\TescoApi\Models\Product;

class ProductResponse extends AbstractResponse
{
    public function __construct(string $responseData)
    {
        parent::__construct($responseData);
    }

    /**
     * @inheritDoc
     */
    protected function populateModels()
    {
        foreach ($this->_data['products'] as $product) {
            $this->_models[] = new Product($product);
        }
    }
}
