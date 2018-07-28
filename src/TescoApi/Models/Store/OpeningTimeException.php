<?php

namespace ImClarky\TescoApi\Models\Store;

use ImClarky\TescoApi\Models\Store\OpeningTime;

/**
 * Opening Times Exceptions CLass
 */
class OpeningTimeException extends OpeningTime
{
    /**
     * Date of the Exception
     *
     * @var string
     */
    protected $_date;

    /**
     * Opening Time Exception Constructor
     *
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        $this->setDate($dataset['date']);
        $dayOfWeek = DateTime::createFromFormat('Y-m-d', $this->_date)->format('N');

        parent::__construct($dayOfWeek, $dataset['hours']);
    }

    /**
     * Set the Exception date
     *
     * @param string $date
     * @return void
     */
    protected function setDate(string $date): void
    {
        $this->_date = $date;
    }

    /**
     * Get the Exception date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->_date;
    }
}
