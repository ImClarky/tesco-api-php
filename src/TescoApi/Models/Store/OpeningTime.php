<?php

namespace ImClarky\TescoApi\Models\Store;

class OpeningTime
{
    protected $_dayOfWeek;
    protected $_isOpen;
    protected $_openingTime;
    protected $_closingTime;

    protected $_days = [
        "mo" => 1,
        "tu" => 2,
        "we" => 3,
        "th" => 4,
        "fr" => 5,
        "sa" => 6,
        "su" => 7,
    ];

    public function __construct($dataset)
    {

    }

    public function getDayOfWeek()
    {
        return $this->_dayOfWeek;
    }

    public function getOpeningTime()
    {
        return $this->_openingTime;
    }

    public function getClosingTime()
    {
        return $this->_closingTime;
    }

    public function isOpen()
    {
        return $this->_isOpen;
    }
}
