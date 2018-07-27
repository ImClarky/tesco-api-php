<?php

namespace ImClarky\TescoApi\Responses;

use ImClarky\TescoApi\Responses\AbstractResponse;
use ImClarky\TescoApi\Models\Store;

/**
 * Store Location Response Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class StoreLocationResponse extends AbstractResponse
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
    protected function populateModels()
    {
        foreach ($this->_data['results'] as $store) {
            $this->_models[] = new Store($store);
        }
    }
}
