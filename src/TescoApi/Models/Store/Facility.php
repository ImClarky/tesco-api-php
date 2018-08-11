<?php

namespace ImClarky\TescoApi\Models\Store;

use ImClarky\TescoApi\Models\Store\OpeningTimesTrait;

/**
 * Store Facility Class
 */
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
    const FACILITY_TWENTYFOUR_HOURS = '24_HOURS';
    const FACILITY_ACCESSIBLE_BABY_CHANGING = 'ACCESSIBLE_BABY_CHANGING';
    const FACILITY_ACCESSIBLE_CAR_PARKING = 'ACCESSIBLE_CAR_PARKING';
    const FACILITY_ACCESSIBLE_TOILETS = 'ACCESSIBLE_TOILETS';
    const FACILITY_AFRO_CARIBBEAN = 'AFRO_CARIBBEAN';
    const FACILITY_ASIAN = 'ASIAN';
    const FACILITY_ASSISTANCE_DOGS = 'ASSISTANCE_DOGS';
    const FACILITY_ATM = 'ATM';
    const FACILITY_AUTOMATIC_DOORS = 'AUTOMATIC_DOORS';
    const FACILITY_BABY_CHANGE = 'BABY_CHANGE';
    const FACILITY_CAFE = 'CAFE';
    const FACILITY_CAR_WASH = 'CAR_WASH';
    const FACILITY_CHICKEN = 'CHICKEN';
    const FACILITY_CLOTHING_COLLECTION = 'CLOTHING_COLLECTION';
    const FACILITY_CLOTHING_ORDER_POINT = 'CLOTHING_ORDER_POINT';
    const FACILITY_CLOTHING_RANGE = 'CLOTHING_RANGE';
    const FACILITY_COINSTAR = 'COINSTAR';
    const FACILITY_COMMUNITY_SPACE = 'COMMUNITY_SPACE';
    const FACILITY_CUMMINS = 'CUMMINS';
    const FACILITY_DBT = 'DBT';
    const FACILITY_DEPOSIT_MONEY = 'DEPOSIT_MONEY';
    const FACILITY_DIRECT_CLICK_AND_COLLECT = 'DIRECT_CLICK_AND_COLLECT';
    const FACILITY_DIRECT_ORDER_POINT = 'DIRECT_ORDER_POINT';
    const FACILITY_DIRECT_RETURNS = 'DIRECT_RETURNS';
    const FACILITY_FISH = 'FISH';
    const FACILITY_FOOD_COLLECTION = 'FOOD_COLLECTION';
    const FACILITY_FREE_FROM = 'FREE_FROM';
    const FACILITY_GAMES = 'GAMES';
    const FACILITY_GREEK = 'GREEK';
    const FACILITY_GROCERY_COLLECTION = 'GROCERY_COLLECTION';
    const FACILITY_HAND_CAR_WASH = 'HAND_CAR_WASH';
    const FACILITY_HEARING_IMPAIRMENTS = 'HEARING_IMPAIRMENTS';
    const FACILITY_INDUCTION_LOOP = 'INDUCTION_LOOP';
    const FACILITY_INTERCOM = 'INTERCOM';
    const FACILITY_JET_WASH = 'JET_WASH';
    const FACILITY_KRISPY_KREME = 'KRISPY_KREME';
    const FACILITY_MAX_PRINT_KIOSK = 'MAX_PRINT_KIOSK';
    const FACILITY_MEAT = 'MEAT';
    const FACILITY_MOBILITY_IMPAIRMENT = 'MOBILITY_IMPAIRMENT';
    const FACILITY_MOMENTUM_99 = 'MOMENTUM_99';
    const FACILITY_MONEYGRAM = 'MONEYGRAM';
    const FACILITY_NON_ASSISTED_WHEELCHAIR_ACCESS = 'NON_ASSISTED_WHEELCHAIR_ACCESS';
    const FACILITY_OPTICIAN = 'OPTICIAN';
    const FACILITY_PAYPOINT = 'PAYPOINT';
    const FACILITY_PAYQWIQ = 'PAYQWIQ';
    const FACILITY_PETROL_FILLING_STATION = 'PETROL_FILLING_STATION';
    const FACILITY_PHARMACY = 'PHARMACY';
    const FACILITY_PHOTO_SHOP = 'PHOTO_SHOP';
    const FACILITY_PIZZA = 'PIZZA';
    const FACILITY_POLISH = 'POLISH';
    const FACILITY_POST_OFFICE = 'POST_OFFICE';
    const FACILITY_RECYCLING = 'RECYCLING';
    const FACILITY_RUG_DOCTOR = 'RUG_DOCTOR';
    const FACILITY_SCAN_AS_YOU_SHOP = 'SCAN_AS_YOU_SHOP';
    const FACILITY_TECH_SUPPORT = 'TECH_SUPPORT';
    const FACILITY_TESCO_MOBILE_SHOP = 'TESCO_MOBILE_SHOP';
    const FACILITY_TIMPSON = 'TIMPSON';
    const FACILITY_TOILETS = 'TOILETS';
    const FACILITY_TRAVEL_MONEY = 'TRAVEL_MONEY';
    const FACILITY_VISUALLY_IMPAIRED = 'VISUALLY_IMPAIRED';
    const FACILITY_WHEELCHAIR_ACCESS = 'WHEELCHAIR_ACCESS';
    const FACILITY_WIFI = 'WIFI';
    const FACILITY_WORLD_FOOD = 'WORLD_FOOD';

    /**
     * Facility Tags
     * NOTE: This may not be the full list
     *       If you find one I've missed, please submit a PR
     */
    const TAG_PUBLIC = 'public';
    const TAG_REFURBISHED = 'refurbished';
    const TAG_FOODRANGE = 'food_range';
    const TAG_ENABLING = 'enabling';

    /**
     * Facility Constructor
     *
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        $this->setName($dataset['name']);
        $this->setDescription($dataset['description']);

        if (array_key_exists('tags', $dataset)) {
            $this->setTags($dataset['tags']);
        }

        if (array_key_exists('openingHours', $dataset)) {
            $this->setTags($dataset['openingHours'][0]['standardOpeningHours']);
        }
    }

    /**
     * Set the Facility Name
     *
     * @param string $name
     * @return void
     */
    protected function setName(string $name): void
    {
        $this->_name = $name;
    }

    /**
     * Set the Facility Description
     *
     * @param string $description
     * @return void
     */
    protected function setDescription(string $description): void
    {
        $this->_description = $description;
    }

    /**
     * Set the Facility Tags
     *
     * @param array $tags
     * @return void
     */
    protected function setTags(array $tags): void
    {
        $this->_tags = $tags;
    }

    /**
     * Get Facility Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Get Facility Description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return  $this->_description;
    }

    /**
     * Get Facility Tags
     *
     * @return array
     */
    public function getTags(): array
    {
        return $this->_tags;
    }

    /**
     * Does this facility have a certain tag?
     *
     * @param string $tag
     * @return boolean
     */
    public function hasTag(string $tag): bool
    {
        return in_array($tag, $this->_tags);
    }
}
