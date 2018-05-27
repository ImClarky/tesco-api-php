<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Requests\Request;
use ImClarky\TescoApi\Requests\Interfaces\PaginationInterface;
use ImClarky\TescoApi\Requests\Traits\PaginationTrait;

class StoreLocationRequest extends Request implements PaginationInterface
{
    use PaginationTrait;

    protected $_sort;
    protected $_filter;
    protected $_like;

    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }
}
