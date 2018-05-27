<?php

namespace ImClarky\TescoApi\Requests\Interfaces;

interface PaginationInterface
{
    public function getNextPage();
    public function getPrevPage();
    public function goToPage(integer $page);
    public function setLimit(integer $limit);
    public function setOffset(integer $offset);
}
