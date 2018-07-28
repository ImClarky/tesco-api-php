<?php

namespace ImClarky\TescoApi\Requests\Interfaces;

use ImClarky\TescoApi\Responses\AbstractResponse;
use ImClarky\TescoApi\Requests\AbstractRequest;

/**
 * Pagination Interface
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
interface PaginationInterface
{
    /**
     * Get the next page of results
     *
     * @return AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getNextPage(): AbstractResponse;

    /**
     * Get the previous page of results
     *
     * @return AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getPrevPage(): AbstractResponse;

    /**
     * Go to a spacific page of results
     *
     * @param integer $page
     * @return AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function goToPage(int $page): AbstractResponse;

    /**
     * Set the request Limit
     *
     * @param integer $limit
     * @return AbstractRequest
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function setLimit(int $limit): AbstractRequest;

    /**
     * Set the request Offset
     *
     * @param integer $offset
     * @return AbstractRequest
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function setOffset(int $offset): AbstractRequest;
}
