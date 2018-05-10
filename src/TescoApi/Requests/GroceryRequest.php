<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Request;
use ImClarky\TescoApi\Requests\Interfaces\PaginationInterface;

class GroceryRequest extends Request implements PaginationInterface
{
    protected $_limit = 10;
    protected $_offset = 0;
}
