<?php

namespace ImClarky\TescoApi\Models\Store;

use ImClarky\TescoApi\Models\Store\OpeningTime;
use ImClarky\TescoApi\Models\Store\OpeningTimeException;
use DateTime;

/**
 * Opening Times Trait
 */
trait OpeningTimesTrait
{
    /**
     * List of opening times
     *
     * @var OpeningTime[]
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_openingTimes = [];

    /**
     * List of opening time exceptions
     *
     * @var OpeningTimeException[]
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_openingTimeExceptions = [];

    /**
     * Set the opening times
     *
     * @param array $times
     * @return void
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function setOpeningTimes(array $times): void
    {
        foreach ($times as $dow => $info) {
            $this->_openingTimes[] = new OpeningTime($dow, $info);
        }
    }

    /**
     * Set the opening time exceptions
     *
     * @param array $times
     * @return void
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function setOpeningTimeExceptions(array $times): void
    {
        foreach ($times as $info) {
            $this->_openingTimeExceptions[] = new OpeningTimeException($info);
        }
    }

    /**
     * Get the store/facility opening times
     *
     * @return array
     */
    public function getOpeningTimes(): array
    {
        return $this->_openingTimes;
    }

    /**
     * Get the store/facility opening time exceptions
     *
     * @return array
     */
    public function getOpeningTimeExceptions(): array
    {
        return $this->_openingTimeExceptions;
    }

    /**
     * Is the store/facility open on a given date
     *
     * @param DateTime $datetime The date to check
     * @return boolean
     */
    public function isOpenOn(DateTime $datetime): bool
    {
        $date = $this->isDateInExceptions($datetime)
            ? $this->getOpeningTimeExceptionByDate($datetime)
            : $this->getOpeningTimeByDate($datetime);

        return $date ? $date->isOpen() : false;
    }

    /**
     * Is the store/facility open now
     *
     * @return boolean
     */
    public function isOpenNow(): bool
    {
        $now = new DateTime();

        $openingTime = $this->isDateInExceptions($now)
            ? $this->getOpeningTimeExceptionByDate($now)
            : $this->getOpeningTimeByDate($now);

        $time = $now->format('Hi');

        return $openingTime && $openingTime->isOpen()
            ? ($openingTime->getOpeningTime() < $time && $openingTime->getClosingTime() > $time)
            : false;
    }

    /**
     * Is the date given in the Opening Times exceptions list
     *
     * @param DateTime $date The date to check
     * @return boolean
     */
    protected function isDateInExceptions(DateTime $date): bool
    {
        $isoDate = $date->format('Y-m-d');

        foreach ($this->_openingTimeExceptions as $exception) {
            if ($exception->getDate() == $isoDate) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get an OpeningTimeException object from a given date
     *
     * @param DateTime $date The date to get
     * @return ImClarky\TescoApi\Models\Store\OpeningTimeException|boolean
     */
    protected function getOpeningTimeExceptionByDate(DateTime $date): ?OpeningTimeException
    {
        $isoDate = $date->format('Y-m-d');

        foreach ($this->_openingTimeExceptions as $exception) {
            if ($exception->getDate() == $isoDate) {
                return $exception;
            }
        }

        return null;
    }

    /**
     * Get an OpeningTime object from a given date
     *
     * @param DateTime $date The date to get
     * @return ImClarky\TescoApi\Models\Store\OpeningTime|boolean
     */
    protected function getOpeningTimeByDate(DateTime $date): ?OpeningTime
    {
        $isoDayOfWeek = $date->format('N');

        foreach ($this->_openingTimes as $openingTime) {
            if ($openingTime->getNumericDayOfWeek() == $isoDayOfWeek) {
                return $openingTime;
            }
        }

        return null;
    }
}
