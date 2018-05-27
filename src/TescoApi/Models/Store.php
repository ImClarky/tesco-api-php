<?php

namespace ImClarky\TescoApi\Models;

use DateTime;

/**
 * Tesco Store object
 *
 * @author Sean Clark <seandclark94@gmail.com>
 */
class Store
{
    /**
     * Unique ID of the store
     *
     * @var string
     */
    protected $_id;

    /**
     * The name of the store
     *
     * @var string
     */
    protected $_name;

    /**
     * The store's Branch Number
     *
     * @var integer
     */
    protected $_branchNumber;

    /**
     * ISO Country Code (2 Characters)
     *
     * @var string
     */
    protected $_isoCountryCode;

    /**
     * ISO Country Subdivision (3 Characters)
     *
     * @var string
     */
    protected $_isoSubdivision;

    /**
     * First line of the store's address
     *
     * @var string
     */
    protected $_addrLine1;

    /**
     * Second line of the store's address
     *
     * @var string
     */
    protected $_addrLine2;

    /**
     * Town the store is in
     *
     * @var string
     */
    protected $_addrTown;

    /**
     * Postcode of the store
     *
     * @var string
     */
    protected $_addrPostcode;

    /**
     * Store's Latitude coordinate
     *
     * @var float
     */
    protected $_geoLatitude;

    /**
     * Store's Longitude coordinate
     *
     * @var float
     */
    protected $_geoLongitude;

    /**
     * The type of store
     *
     * @var string
     */
    protected $_type;

    /**
     * The category of the store
     *
     * @var string
     */
    protected $_category;

    /**
     * The status of the store
     *
     * @var string
     */
    protected $_status;

    /**
     * The distance the store is from the queried 'near' param
     *
     * @var float
     */
    protected $_distanceValue;

    /**
     * The measurement $_distanceValue is measured in
     *
     * @var string
     */
    protected $_distanceMeasurement;

    /**
     * Array of OpeningTime objects
     *
     * @var array
     */
    protected $_openingTimes = [];

    /**
     * Array of OpeningTimeExecption objects
     *
     * @var array
     */
    protected $_openingTimeExceptions = [];

    /**
     * Array of Facility objects
     *
     * @var array
     */
    protected $_facilities = [];

    /**
     * Constructor
     * Create a new Store object from the result dataset
     *
     * @param stdClass $dataset
     */
    public function __construct(stdClass $dataset)
    {

    }

    /**
     * Get the Store name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Get the Store Branch Number
     *
     * @return integer
     */
    public function getBranchNumber()
    {
        return $this->_branchNumber;
    }

    /**
     * Get the Store ISO country code
     *
     * @return string
     */
    public function getIsoCountryCode()
    {
        return $this->_isoCountryCode;
    }

    /**
     * Get the first line of the store's address
     *
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->_addrLine1;
    }

    /**
     * Get the second line of the store's address
     *
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->_addrLine2;
    }

    /**
     * Get the Town the store is located in
     *
     * @return string
     */
    public function getAddressTown()
    {
        return $this->_addrTown;
    }

    /**
     * Get the store's postcode
     *
     * @return string
     */
    public function getAddressPostcode()
    {
        return $this->_addrPostcode;
    }

    /**
     * Get the full address of the store
     *
     * @return string
     */
    public function getFullAddress()
    {
        return "{$this->getAddressLine1()},
                {$this->getAddressLine2()},
                {$this->getAddressTown()},
                {$this->getAddressPostcode()}";
    }

    /**
     * Get the store's type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Get the store category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * Get the latitude of the store
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->_geoLatitude;
    }

    /**
     * Get the longitude of the store
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->_geoLongitude;
    }

    /**
     * Get the lat-long geo coordinates of the store
     *
     * @return string
     */
    public function getGeoCoordinates()
    {
        return "{$this->getLatitude()}, {$this->getLongitude()}";
    }

    /**
     * Get the store status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * Get the distance the store is from the 'near' query parameter
     *
     * @return string
     */
    public function getDistance()
    {
        return "{$this->_distanceValue} " . ucwords($this->_distanceMeasurement);
    }

    /**
     * Does the store have a certain facility
     * Use Facility constants to check for facility
     *
     * eg $store->hasFacility(Facility::ACCESSIBLE_CAR_PARKING)
     *
     * @param string $type The type of facility
     * @return boolean
     */
    public function hasFacility(string $type)
    {
        foreach ($this->facilities as $facility) {
            if ($facility->getName() === $type) {
                return true;
            }
        }

        return false;
    }

    /**
     * Does the store have a set of facilities
     * Use Facility constants to check for facility
     *
     * eg $store->hasFacilities([
     *      Facility::ACCESSIBLE_CAR_PARKING
     *      Facility::NON_ASSISTED_WHEELCHAIR_ACCESS
     *      Facility::ACCESSIBLE_TOILETS
     * ])
     *
     * @param array $facilities
     * @return boolean
     */
    public function hasFacilities(array $facilities)
    {
        if (empty($facilities)) {
            return false;
        }

        foreach ($facilities as $facility) {
            if (!$this->hasFacility($facility)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the store's facilities
     *
     * @return array
     */
    public function getFacilities()
    {
        return $this->_facilities;
    }

    /**
     * Get the store's opening times
     *
     * @return array
     */
    public function getOpeningTimes()
    {
        return $this->_openingTimes;
    }

    /**
     * Get the store's opening time exceptions
     *
     * @return array
     */
    public function getOpeningTimesExceptions()
    {
        return $this->_openingTimeExceptions;
    }

    /**
     * Is the store open on a given date
     *
     * @param DateTime $datetime The date to check
     * @return boolean
     */
    public function isOpenOn(DateTime $datetime)
    {
        $date = $this->getOpeningTimeByDate($datetime);
        return $date->isOpen();
    }

    /**
     * Is the store open now
     *
     * @return boolean
     */
    public function isOpenNow()
    {
        $now = new DateTime();

        $openingTime = $this->isDateInExceptions($now)
            ? $this->getOpeningTimeExceptionByDate($now)
            : $this->getOpeningTimeByDate($now);

        $time = $now->format('Hi');

        return $openingTime->isOpen()
            ? ($openingTime->getOpeningTime() < $time && $openingTime->getClosingTime() > $time)
            : false;
    }

    /**
     * Is the date given in the Opening Times exceptionns list
     *
     * @param DateTime $date The date to check
     * @return boolean
     */
    protected function isDateInExceptions(DateTime $date)
    {
        $isoDate = $date->format('Y-m-d');

        foreach ($this->_openingTimeExceptions as $exception) {
            if ($exception->date == $isoDate) {
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
    protected function getOpeningTimeExceptionByDate(DateTime $date)
    {
        $isoDate = $date->format('Y-m-d');

        foreach ($this->_openingTimeExceptions as $exception) {
            if ($exception->getDate() == $isoDate) {
                return $exception;
            }
        }

        return false;
    }

    /**
     * Get an OpeningTime object from a given date
     *
     * @param DateTime $date The date to get
     * @return ImClarky\TescoApi\Models\Store\OpeningTime|boolean
     */
    protected function getOpeningTimeByDate(DateTime $date)
    {
        $isoDayOfWeek = $date->format('N');

        foreach ($this->_openingTimeExceptions as $exception) {
            if ($exception->getDayOfWeek() == $isoDayOfWeek) {
                return $exception;
            }
        }

        return false;
    }
}
