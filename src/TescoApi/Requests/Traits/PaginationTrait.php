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
        if ($this->_offset > 0) {
            $this->_offset = max($this->_offset - $this->_limit, 0);
        }

        $this->send();
    }

    public function goToPage(int $page)
    {
        $this->_offset = $this->_limit * ($page - 1);

        $this->send();
    }

    public function setLimit(int $limit)
    {
        $this->_limit = $limit;
        return $this;
    }

    public function setOffset(int $offset)
    {
        $this->_offset = $offset;
        return $this;
    }
}
