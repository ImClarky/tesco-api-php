<?php

namespace ImClarky\TescoApi\Responses;

use ImClarky\TescoApi\Responses\AbstractResponse;
use ImClarky\TescoApi\Models\Grocery;

/**
 * Product Response Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class ProductResponse extends AbstractResponse
{
    /**
     * @inheritDoc
     */
    public function __construct(string $responseData)
    {
        parent::__construct($responseData);
    }

    /**
     * @inheritDoc
     */
    protected function populateModels(): void
    {
        foreach ($this->_data['products']['results'] as $product) {
            $this->_models[] = new Grocery($product);
        }
    }
}
