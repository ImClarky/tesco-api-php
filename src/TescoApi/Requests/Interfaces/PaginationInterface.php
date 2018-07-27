<?php

namespace ImClarky\TescoApi\Requests\Interfaces;

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
     * @return ImClarky\TescoApi\Responses\AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getNextPage();

    /**
     * Get the previous page of results
     *
     * @return ImClarky\TescoApi\Responses\AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getPrevPage();

    /**
     * Go to a spacific page of results
     *
     * @param integer $page
     * @return ImClarky\TescoApi\Responses\AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function goToPage(int $page);

    /**
     * Set the request Limit
     *
     * @param integer $limit
     * @return ImClarky\TescoApi\Requests\AbstractRequest
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function setLimit(int $limit);

    /**
     * Set the request Offset
     *
     * @param integer $offset
     * @return ImClarky\TescoApi\Requests\AbstractRequest
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function setOffset(int $offset);
}
