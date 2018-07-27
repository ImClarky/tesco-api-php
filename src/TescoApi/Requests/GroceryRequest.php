<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Requests\AbstractRequest;
use ImClarky\TescoApi\Requests\Interfaces\PaginationInterface;
use ImClarky\TescoApi\Requests\Traits\PaginationTrait;

class GroceryRequest extends AbstractRequest implements PaginationInterface
{
    use PaginationTrait;
}
