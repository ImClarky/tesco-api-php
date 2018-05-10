<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Request;

class StoreLocationRequest extends Request
{
    protected $_limit = 10;
    protected $_offset = 0;
    protected $_sort;
    protected $_filter;
    protected $_like;

    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }
}
