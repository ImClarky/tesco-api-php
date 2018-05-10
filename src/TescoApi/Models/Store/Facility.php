<?php

namespace ImClarky\TescoApi\Models\Store;

class Facility
{
    protected $_name;
    protected $_description;
    protected $_tags = [];
    protected $_openingTimes = [];

    const TWENTYFOUR_HOURS = '24_HOURS';
    const ACCESSIBLE_BABY_CHANGING = 'ACCESSIBLE_BABY_CHANGING';
    const ACCESSIBLE_CAR_PARKING = 'ACCESSIBLE_CAR_PARKING';
    const ACCESSIBLE_TOILETS = 'ACCESSIBLE_TOILETS';
    const AFRO_CARIBBEAN = 'AFRO_CARIBBEAN';
    const ASIAN = 'ASIAN';
    const ASSISTANCE_DOGS = 'ASSISTANCE_DOGS';
    const ATM = 'ATM';
    const AUTOMATIC_DOORS = 'AUTOMATIC_DOORS';

    public function __construct()
    {

    }
}
