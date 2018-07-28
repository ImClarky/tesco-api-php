<?php

namespace ImClarky\TescoApi\Models\Store;

use ImClarky\TescoApi\Models\Store\OpeningTime;
use ImClarky\TescoApi\Models\Store\OpeningTimesTrait;

class Facility
{
    use OpeningTimesTrait;

    /**
     * Facility Name
     *
     * @var string
     */
    protected $_name;

    /**
     * Facility Description
     *
     * @var string
     */
    protected $_description;

    /**
     * Facility tags
     *
     * @var array
     */
    protected $_tags = [];

    /**
     * Facility Types
     *
     * NOTE: This may not be the full list
     *       If you find one I've missed, please submit a PR
     */
    const TWENTYFOUR_HOURS = '24_HOURS';
    const ACCESSIBLE_BABY_CHANGING = 'ACCESSIBLE_BABY_CHANGING';
    const ACCESSIBLE_CAR_PARKING = 'ACCESSIBLE_CAR_PARKING';
    const ACCESSIBLE_TOILETS = 'ACCESSIBLE_TOILETS';
    const AFRO_CARIBBEAN = 'AFRO_CARIBBEAN';
    const ASIAN = 'ASIAN';
    const ASSISTANCE_DOGS = 'ASSISTANCE_DOGS';
    const ATM = 'ATM';
    const AUTOMATIC_DOORS = 'AUTOMATIC_DOORS';
    const BABY_CHANGE = 'BABY_CHANGE';
    const CAFE = 'CAFE';
    const CAR_WASH = 'CAR_WASH';
    const CHICKEN = 'CHICKEN';
    const CLOTHING_COLLECTION = 'CLOTHING_COLLECTION';
    const CLOTHING_ORDER_POINT = 'CLOTHING_ORDER_POINT';
    const CLOTHING_RANGE = 'CLOTHING_RANGE';
    const COINSTAR = 'COINSTAR';
    const COMMUNITY_SPACE = 'COMMUNITY_SPACE';
    const CUMMINS = 'CUMMINS';
    const DBT = 'DBT';
    const DEPOSIT_MONEY = 'DEPOSIT_MONEY';
    const DIRECT_CLICK_AND_COLLECT = 'DIRECT_CLICK_AND_COLLECT';
    const DIRECT_ORDER_POINT = 'DIRECT_ORDER_POINT';
    const DIRECT_RETURNS = 'DIRECT_RETURNS';
    const FISH = 'FISH';
    const FOOD_COLLECTION = 'FOOD_COLLECTION';
    const FREE_FROM = 'FREE_FROM';
    const GAMES = 'GAMES';
    const GREEK = 'GREEK';
    const GROCERY_COLLECTION = 'GROCERY_COLLECTION';
    const HAND_CAR_WASH = 'HAND_CAR_WASH';
    const HEARING_IMPAIRMENTS = 'HEARING_IMPAIRMENTS';
    const INDUCTION_LOOP = 'INDUCTION_LOOP';
    const INTERCOM = 'INTERCOM';
    const JET_WASH = 'JET_WASH';
    const KRISPY_KREME = 'KRISPY_KREME';
    const MAX_PRINT_KIOSK = 'MAX_PRINT_KIOSK';
    const MEAT = 'MEAT';
    const MOBILITY_IMPAIRMENT = 'MOBILITY_IMPAIRMENT';
    const MOMENTUM_99 = 'MOMENTUM_99';
    const MONEYGRAM = 'MONEYGRAM';
    const NON_ASSISTED_WHEELCHAIR_ACCESS = 'NON_ASSISTED_WHEELCHAIR_ACCESS';
    const OPTICIAN = 'OPTICIAN';
    const PAYPOINT = 'PAYPOINT';
    const PAYQWIQ = 'PAYQWIQ';
    const PETROL_FILLING_STATION = 'PETROL_FILLING_STATION';
    const PHARMACY = 'PHARMACY';
    const PHOTO_SHOP = 'PHOTO_SHOP';
    const PIZZA = 'PIZZA';
    const POLISH = 'POLISH';
    const POST_OFFICE = 'POST_OFFICE';
    const RECYCLING = 'RECYCLING';
    const RUG_DOCTOR = 'RUG_DOCTOR';
    const SCAN_AS_YOU_SHOP = 'SCAN_AS_YOU_SHOP';
    const TECH_SUPPORT = 'TECH_SUPPORT';
    const TESCO_MOBILE_SHOP = 'TESCO_MOBILE_SHOP';
    const TIMPSON = 'TIMPSON';
    const TOILETS = 'TOILETS';
    const TRAVEL_MONEY = 'TRAVEL_MONEY';
    const VISUALLY_IMPAIRED = 'VISUALLY_IMPAIRED';
    const WHEELCHAIR_ACCESS = 'WHEELCHAIR_ACCESS';
    const WIFI = 'WIFI';
    const WORLD_FOOD = 'WORLD_FOOD';

    const TAG_PUBLIC = 'public';
    const TAG_REFURBISHED = 'refurbished';
    const TAG_FOODRANGE = 'food_range';
    const TAG_ENABLING = 'enabling';

    public function __construct(array $dataset)
    {
        $this->setName($dataset['name']);
        $this->setDescription($dataset['description']);

        if ($tags = $dataset['tags']) {
            $this->setTags($tags);
        }

        if ($times = $dataset['openingHours'][0]['standardOpeningHours']) {
            $this->setOpeningTimes($times);
        }
    }

    protected function setName(string $name)
    {
        $this->_name = $name;
    }

    protected function setDescription(string $description)
    {
        $this->_description = $description;
    }

    protected function setTags(array $tags)
    {
        $this->_tags = $tags;
    }
}
