<?php

namespace ImClarky\TescoApi\Models\Store;

class OpeningTime
{
    protected $_dayOfWeek;
    protected $_isOpen;
    protected $_openingTime;
    protected $_closingTime;

    protected static $_numericDays = [
        "mo" => 1,
        "tu" => 2,
        "we" => 3,
        "th" => 4,
        "fr" => 5,
        "sa" => 6,
        "su" => 7,
    ];

    protected static $_stringDays = [
        "mo" => "Monday",
        "tu" => "Tuesday",
        "we" => "Wednesday",
        "th" => "Thursday",
        "fr" => "Friday",
        "sa" => "Saturday",
        "su" => "Sunday",
    ];

    public function __construct($dayOfWeek, $data)
    {
        $this->setDayOfWeek($dayOfWeek);
        $this->setIsOpen($data['isOpen']);

        if ($this->isOpen()) {
            $this->setOpeningTime($data['open']);
            $this->setClosingTime($data['close']);
        }
    }

    protected function setDayOfWeek(string $dayOfWeek)
    {
        $this->_dayOfWeek = $dayOfWeek;
    }

    protected function setIsOpen(string $isOpen)
    {
        $this->_isOpen = $isOpen === "true";
    }

    protected function setOpeningTime(string $time)
    {
        $this->_openingTime = $time;
    }

    protected function setClosingTime(string $time)
    {
        $this->_closingTime = $time;
    }

    public function getDayOfWeek()
    {
        return $this->_dayOfWeek;
    }

    public function getNumericDayOfWeek()
    {
        return static::$_numericDays[$this->_dayOfWeek];
    }

    public function getTextDayOfWeek()
    {
        return static::$_stringDays[$this->_dayOfWeek];
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
