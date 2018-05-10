<?php

namespace ImClarky\TescoApi\Models\Store;

use ImClarky\TescoApi\Models\Store\OpeningTime;

class OpeningTimeException extends OpeningTime
{
    protected $_date;

    public function __construct($dataset)
    {
        parent::__construct($dataset);
    }

    public function getDate()
    {
        return $this->_date;
    }
}
