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

    public function goToPage($page)
    {

    }

    public function setLimit($limit)
    {
        $this->_limit = $limit;
        return $this;
    }

    public function setOffset($offset)
    {
        $this->_offset = $offset;
        return $this;
    }
}
