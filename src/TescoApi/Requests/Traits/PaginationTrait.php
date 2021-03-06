<?php

namespace ImClarky\TescoApi\Requests\Traits;

use ImClarky\TescoApi\Responses\AbstractResponse;
use ImClarky\TescoApi\Requests\AbstractRequest;

/**
 * Pagination trait
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
trait PaginationTrait
{
    /**
     * How many results to fetch
     *
     * @var integer
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_limit = 10;

    /**
     * How many results to offset by
     *
     * @var integer
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_offset = 0;

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getNextPage(): AbstractResponse
    {
        $this->_offest = $this->getOffset() + $this->getLimit();

        return $this->send();
    }

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getPrevPage(): AbstractResponse
    {
        if ($this->_offset > 0) {
            $this->_offset = max($this->getOffset() - $this->getLimit(), 0);
        }

        return $this->send();
    }

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function goToPage(int $page): AbstractResponse
    {
        $this->_offset = $this->getLimit() * ($page - 1);

        return $this->send();
    }

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function setLimit(int $limit): AbstractRequest
    {
        $this->_limit = $limit;
        return $this;
    }

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function setOffset(int $offset): AbstractRequest
    {
        $this->_offset = $offset;
        return $this;
    }

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getOffset(): int
    {
        return $this->_offset;
    }

    /**
     * @inheritDoc
     *
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getLimit(): int
    {
        return $this->_limit;
    }

    /**
     * Get the Pagination Query String
     *
     * @return string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function getPaginationQueryString(): string
    {
        return "limit={$this->getLimit()}&offset={$this->getOffset()}";
    }
}
