<?php

namespace ImClarky\TescoApi\Models;

use ImClarky\TescoApi\Models\AbstractModel;
use ImClarky\TescoApi\Models\Store\Facility;
use ImClarky\TescoApi\Models\Store\OpeningTimesTrait;

/**
 * Tesco Store object
 *
 * @author Sean Clark <seandclark94@gmail.com>
 */
class Store extends AbstractModel
{
    use OpeningTimesTrait;

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
     * @var int
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
     * Array of Facility objects
     *
     * @var array
     */
    protected $_facilities = [];

    /**
     * @inheritDoc
     *
     * @var array
     */
    protected $_dataMap = [
        'id' => 'id',
        'name' => 'name',
        'branchNumber' => 'branchNumner',
        'isoCountryCode' => 'isoCountryCode',
        'isoSubdivision' => 'isoSubdivision',
        'lines' => 'setAddressLines',
        'town' => 'addrTown',
        'postcode' => 'addrPostcode',
        'latitude' => 'geoLatitude',
        'longitude' => 'geoLongitude',
        'type' => 'type',
        'category' => 'category',
        'currentStatus' => 'status',
        'unit' => 'distanceMeasurement',
        'value' => 'distanceValue',
        'standardOpeningHours' => 'setOpeningTimes',
        'exceptions' => 'setOpeningTimeExceptions',
        'facilities' => 'setFacilities'
    ];

    /**
     * Store constants
     */
     const TYPE_EXTRA = 'Extra';
     const TYPE_METRO = 'Metro';
     const TYPE_EXPRESS = 'Express';
     const TYPE_SUPERSTORE = 'Superstore';

     const CATEGORY_STORE = 'Store';
     const CATEGORY_DISTRIBUTIONCENTRE = 'Distribution Centre';
     const CATEGORY_CFC = 'CFC';
     const CATEGORY_TRUNKINGSPOKE = 'Trunking Spoke';

    /**
     * Constructor
     * Create a new Store object from the result dataset
     *
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        parent::__construct($dataset);
    }

    /**
     * Set the Store Facilities
     *
     * @param array $facilities
     * @return void
     */
    protected function setFacilities(array $facilities): void
    {
        foreach ($facilities as $facility) {
            $this->_facilities[] = new Facility($facility);
        }
    }

    /**
     * Set the Store Address lines
     *
     * @param array $lines
     * @return void
     */
    protected function setAddressLines(array $lines): void
    {
        foreach ($lines as $line) {
            $this->{'_addrLine' . $line['lineNumber']} = $line['text'];
        }
    }

    /**
     * Get the Store name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Get the Store Branch Number
     *
     * @return integer
     */
    public function getBranchNumber(): int
    {
        return $this->_branchNumber;
    }

    /**
     * Get the Store ISO country code
     *
     * @return string
     */
    public function getIsoCountryCode(): string
    {
        return $this->_isoCountryCode;
    }

    /**
     * Get the first line of the store's address
     *
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->_addrLine1;
    }

    /**
     * Get the second line of the store's address
     *
     * @return string
     */
    public function getAddressLine2(): string
    {
        return $this->_addrLine2;
    }

    /**
     * Get the Town the store is located in
     *
     * @return string
     */
    public function getAddressTown(): string
    {
        return $this->_addrTown;
    }

    /**
     * Get the store's postcode
     *
     * @return string
     */
    public function getAddressPostcode(): string
    {
        return $this->_addrPostcode;
    }

    /**
     * Get the full address of the store
     *
     * @return string
     */
    public function getFullAddress(): string
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
    public function getType(): string
    {
        return $this->_type;
    }

    /**
     * Is the store a specified type
     *
     * @param string $type
     * @return boolean
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function isType(string $type): bool
    {
        return $this->_type === $type;
    }

    /**
     * Get the store category
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->_category;
    }

    /**
     * Is the store a specified category
     *
     * @param string $type
     * @return boolean
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function isCategory(string $category): bool
    {
        return $this->_category === $category;
    }

    /**
     * Get the latitude of the store
     *
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->_geoLatitude;
    }

    /**
     * Get the longitude of the store
     *
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->_geoLongitude;
    }

    /**
     * Get the lat-long geo coordinates of the store
     *
     * @return string
     */
    public function getGeoCoordinates(): string
    {
        return "{$this->getLatitude()}, {$this->getLongitude()}";
    }

    /**
     * Get the store status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->_status;
    }

    /**
     * Get the distance the store is from the 'near' query parameter
     *
     * @return string
     */
    public function getDistance(): string
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
    public function hasFacility(string $type): bool
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
    public function hasFacilities(array $facilities): bool
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
    public function getFacilities(): array
    {
        return $this->_facilities;
    }
}
