<?php

namespace ImClarky\TescoApi\Requests\Interfaces;

interface PaginationInterface
{
    public function getNextPage();
    public function getPrevPage();
    public function goToPage($page);
    public function setLimit($limit);
    public function setOffset($offset);
}
