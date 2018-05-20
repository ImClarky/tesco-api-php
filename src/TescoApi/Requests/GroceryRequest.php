<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Request;
use ImClarky\TescoApi\Requests\Interfaces\PaginationInterface;
use ImClarky\TescoApi\Requests\Traits\PaginationTrait;

class GroceryRequest extends Request implements PaginationInterface
{
    use PaginationTrait;
}
