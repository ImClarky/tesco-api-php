<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Requests\AbstractRequest;
use ImClarky\TescoApi\Requests\Interfaces\PaginationInterface;
use ImClarky\TescoApi\Requests\Traits\PaginationTrait;
use ImClarky\TescoApi\Responses\GroceryResponse;
use ImClarky\TescoApi\Exceptions\RequestException;
use ImClarky\TescoApi\Responses\AbstractResponse;

/**
 * Grocery Request Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class GroceryRequest extends AbstractRequest implements PaginationInterface
{
    use PaginationTrait;

    /**
     * Search Term
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_searchTerm;

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_uri = 'grocery/products';

    /**
     * Add a search term to query
     *
     * @param string $search
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addSearchTerm(string $search): self
    {
        $this->_searchTerm = $search;
        return $this;
    }

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function buildQueryString(): void
    {
        if (empty($this->_searchTerm)) {
            throw new RequestException('Search term must be supplied');
        }

        $this->_queryString .= "query=" . $_searchTerm
            . "&limit=" . $this->getLimit()
            . "&offset=" . $this->getOffset();
    }

    /**
     * Create a new response instance
     *
     * @return GroceryResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function resolveResponse(): AbstractResponse
    {
        return new GroceryResponse($this->_results);
    }
}
