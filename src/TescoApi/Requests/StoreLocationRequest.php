<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Requests\AbstractRequest;
use ImClarky\TescoApi\Requests\Store\Filter;
use ImClarky\TescoApi\Requests\Store\Sort;
use ImClarky\TescoApi\Requests\Store\Like;
use ImClarky\TescoApi\Requests\Interfaces\PaginationInterface;
use ImClarky\TescoApi\Requests\Traits\PaginationTrait;
use ImClarky\TescoApi\Responses\StoreLocationResponse;

class StoreLocationRequest extends AbstractRequest implements PaginationInterface
{
    use PaginationTrait;

    protected $_uri = "/locations/search";

    protected $_sort;
    protected $_filter;
    protected $_like;

    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }

    public function addSort(string $type, string $value)
    {
        if (!$this->_sort instanceof Sort) {
            $this->_sort = new Sort;
        }

        $this->_sort->addOption($type, $value);

        return $this;
    }

    public function addFilter(string $type, string $value)
    {
        if (!$this->_filter instanceof Filter) {
            $this->_filter = new Filter;
        }

        $this->_filter->addOption($type, $value);

        return $this;
    }

    public function addLike(string $type, string $value)
    {
        if (!$this->_like instanceof Like) {
            $this->_like = new Like;
        }

        $this->_like->addOption($type, $value);

        return $this;
    }

    protected function buildQueryString()
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

        $this->_queryString .= implode('&', $segments);
    }

    protected function resolveResponse()
    {
        return new StoreLocationResponse($this->_result);
    }
}
