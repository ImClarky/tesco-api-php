<?php

namespace ImClarky\TescoApi\Models\Store;

use ImClarky\TescoApi\Models\Store\OpeningTime;

class OpeningTimeException extends OpeningTime
{
    protected $_date;

    public function __construct($dataset)
    {
        $this->setDate($dataset['date']);
        $dayOfWeek = DateTime::createFromFormat('Y-m-d', $this->_date)->format('N');

        parent::__construct($dayOfWeek, $dataset['hours']);
    }

    protected function setDate(string $date)
    {
        $this->_date = $date;
    }

    public function getDate()
    {
        return $this->_date;
    }
}
