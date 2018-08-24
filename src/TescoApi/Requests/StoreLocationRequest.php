<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Requests\AbstractRequest;
use ImClarky\TescoApi\Requests\Store\Filter;
use ImClarky\TescoApi\Requests\Store\Sort;
use ImClarky\TescoApi\Requests\Store\Like;
use ImClarky\TescoApi\Requests\Interfaces\PaginationInterface;
use ImClarky\TescoApi\Requests\Traits\PaginationTrait;
use ImClarky\TescoApi\Responses\AbstractResponse;

/**
 * Store Location Request Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class StoreLocationRequest extends AbstractRequest implements PaginationInterface
{
    use PaginationTrait;

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_uri = "/locations/search";

    /**
     * Instance of the Sort Class
     *
     * @var Sort
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_sort;

    /**
     * Instance of the Filter Class
     *
     * @var Filter
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_filter;

    /**
     * Instance of the Like Class
     *
     * @var Like
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_like;

    /**
     * Create a new request instance
     *
     * @param string $apiKey
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Add a new Sort parameter
     *
     * @param string $type
     * @param string $value
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addSort(string $type, string $value): self
    {
        if (!$this->_sort instanceof Sort) {
            $this->_sort = new Sort;
        }

        $this->_sort->addOption($type, $value);

        return $this;
    }

    /**
     * Add a new Filter parameter
     *
     * @param string $type
     * @param mixed $value
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addFilter(string $type, $value): self
    {
        if (!$this->_filter instanceof Filter) {
            $this->_filter = new Filter;
        }

        $this->_filter->addOption($type, $value);

        return $this;
    }

    /**
     * Add a new Like parameter
     *
     * @param string $type
     * @param mixed $value
     * @param boolean $start
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addLike(string $type, $value, bool $start = false): self
    {
        if (!$this->_like instanceof Like) {
            $this->_like = new Like;
        }

        $this->_like->addOption($type, $value, $start);

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function buildQueryString(): void
    {
        $segments = [];

        $params = [
            Sort::$_queryName => $this->_sort instanceof Sort ? $this->_sort->buildQuerySegment() : null,
            Filter::$_queryName => $this->_filter instanceof Filter ? $this->_filter->buildQuerySegment() : null,
            Like::$_queryName => $this->_like instanceof Like ? $this->_like->buildQuerySegment() : null,
        ];

        foreach ($params as $param => $values) {
            if (empty($values)) {
                continue;
            }

            $segments[] = $param . "=" . $values;
        }

        $this->_queryString .= implode('&', $segments)
            . "&limit=" . $this->getLimit()
            . "&offset=" . $this->getOffset();
    }

    /**
     * Create a new Response Instance
     *
     * @return AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function resolveResponse(): AbstractResponse
    {
        return new StoreLocationResponse($this->_result);
    }
}
