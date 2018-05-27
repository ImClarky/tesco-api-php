<?php

namespace ImClarky\TescoApi\Requests\Traits;

trait PaginationTrait
{
    protected $_limit = 10;
    protected $_offset = 0;

    public function getNextPage()
    {

    }

    public function getPrevPage()
    {

    }

    public function goToPage(integer $page)
    {

    }

    public function setLimit(integer $limit)
    {
        $this->_limit = $limit;
        return $this;
    }

    public function setOffset(integer $offset)
    {
        $this->_offset = $offset;
        return $this;
    }
}
