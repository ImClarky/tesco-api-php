<?php

namespace ImClarky\TescoApi\Requests\Traits;

trait PaginationTrait
{
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
