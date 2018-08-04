<?php

namespace ImClarky\TescoApi\Models\Store;

/**
 * Opening Times Class
 */
class OpeningTime
{
    /**
     * 2 character Day of the Week
     *
     * @var string
     */
    protected $_dayOfWeek;

    /**
     * Is the entity Open for this Opening Time
     *
     * @var boolean
     */
    protected $_isOpen;

    /**
     * Opening Time
     *
     * @var string
     */
    protected $_openingTime;

    /**
     * Clasing Time
     *
     * @var string
     */
    protected $_closingTime;

    /**
     * Numeric Representation of Days
     *
     * @var array
     */
    protected static $_numericDays = [
        "mo" => 1,
        "tu" => 2,
        "we" => 3,
        "th" => 4,
        "fr" => 5,
        "sa" => 6,
        "su" => 7,
    ];

    /**
     * String Representation of Days
     *
     * @var array
     */
    protected static $_stringDays = [
        "mo" => "Monday",
        "tu" => "Tuesday",
        "we" => "Wednesday",
        "th" => "Thursday",
        "fr" => "Friday",
        "sa" => "Saturday",
        "su" => "Sunday",
    ];

    /**
     * Opening Time Constructor
     *
     * @param string $dayOfWeek
     * @param array $data
     */
    public function __construct(string $dayOfWeek, array $data)
    {
        $this->setDayOfWeek($dayOfWeek);
        $this->setIsOpen($data['isOpen']);

        if ($this->isOpen()) {
            $this->setOpeningTime(
                array_key_exists('open', $data) ? $data['open'] : "0000"
            );
            $this->setClosingTime(
                array_key_exists('close', $data) ? $data['close'] : "2400"
            );
        }
    }

    /**
     * Set the Day of the Week
     *
     * @param string $dayOfWeek
     * @return void
     */
    protected function setDayOfWeek(string $dayOfWeek): void
    {
        $this->_dayOfWeek = $dayOfWeek;
    }

    /**
     * Set the Open status
     *
     * @param string $isOpen
     * @return void
     */
    protected function setIsOpen(string $isOpen): void
    {
        $this->_isOpen = $isOpen === "true";
    }

    /**
     * Set the Opening Time
     *
     * @param string $time
     * @return void
     */
    protected function setOpeningTime(string $time): void
    {
        $this->_openingTime = $time;
    }

    /**
     * Set the Closing Time
     *
     * @param string $time
     * @return void
     */
    protected function setClosingTime(string $time): void
    {
        $this->_closingTime = $time;
    }

    /**
     * Get the 2 Character Day of the Week
     *
     * @return string
     */
    public function getDayOfWeek(): string
    {
        return $this->_dayOfWeek;
    }

    /**
     * Get the Numeric Day of the Week
     * Monday = 1; Sunday = 7
     *
     * @return integer
     */
    public function getNumericDayOfWeek(): int
    {
        return static::$_numericDays[$this->_dayOfWeek];
    }

    /**
     * Get the Text version of the Day of the Week
     *
     * @return string
     */
    public function getTextDayOfWeek(): string
    {
        return static::$_stringDays[$this->_dayOfWeek];
    }

    /**
     * Get the Opening Time
     *
     * @return integer
     */
    public function getOpeningTime(): int
    {
        return $this->_openingTime;
    }

    /**
     * Get the Closing Time
     *
     * @return integer
     */
    public function getClosingTime(): int
    {
        return $this->_closingTime;
    }

    /**
     * Is the entity Open
     *
     * @return boolean
     */
    public function isOpen(): bool
    {
        return $this->_isOpen;
    }
}
