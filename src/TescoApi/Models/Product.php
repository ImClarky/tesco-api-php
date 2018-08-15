<?php

namespace ImClarky\TescoApi\Models;

use ImClarky\TescoApi\Models\AbstractModel;
use ImClarky\TescoApi\Models\Product\Gda;
use ImClarky\TescoApi\Models\Product\Nutrition;

/**
 * Product Class
 */
class Product extends AbstractModel
{
    /**
     * Product GTIN/EAN13 Number
     *
     * @var string
     */
    protected $_gtin;

    /**
     * Product Tesco Product Number Base (TPNB) number
     *
     * @var string
     */
    protected $_tpnb;

    /**
     * Product Tesco Product Number Consumer (TPNC) number
     *
     * @var string
     */
    protected $_tpnc;

    /**
     * Product Description
     *
     * @var string
     */
    protected $_description;

    /**
     * Product Brand Name
     *
     * @var string
     */
    protected $_brand;

    /**
     * Product Quantity
     *
     * @var int
     */
    protected $_quantity;

    /**
     * Product Total Quantity
     *
     * @var int
     */
    protected $_totalQuantity;

    /**
     * Product Quantity Unit of Measure
     *
     * @var string
     */
    protected $_unitOfMeasure;

    /**
     * Product Net Contents
     *
     * @var string
     */
    protected $_netContents;

    /**
     * Product Average Measure
     *
     * @var string
     */
    protected $_averageMeasure;

    /**
     * Product is Food?
     *
     * @var bool
     */
    protected $_isFood;

    /**
     * Product is Drink?
     *
     * @var bool
     */
    protected $_isDrink;

    /**
     * Product is Hazardous?
     *
     * @var bool
     */
    protected $_isHazardous;

    /**
     * Product is Non Liquid Analgesic?
     *
     * @var bool
     */
    protected $_isNonLiquidAnalgesic;

    /**
     * Product contains Loperamide?
     *
     * @var bool
     */
    protected $_containsLoperamide;

    /**
     * Product Storage Type
     *
     * @var string
     */
    protected $_storageType;

    /**
     * Product Width
     *
     * @var float
     */
    protected $_width;

    /**
     * Product Height
     *
     * @var float
     */
    protected $_height;

    /**
     * Product Depth
     *
     * @var float
     */
    protected $_depth;

    /**
     * Product Dimension Unit of Measure
     *
     * @var string
     */
    protected $_dimensionUnitOfMeasure;

    /**
     * Product Weight
     *
     * @var float
     */
    protected $_weight;

    /**
     * Product Weight Unit of Measurement
     *
     * @var string
     */
    protected $_weightUnitOfMeasure;

    /**
     * Product Volume
     *
     * @var float
     */
    protected $_volume;

    /**
     * Product Volume Unit of measure
     *
     * @var string
     */
    protected $_volumeUnitOfMeasure;

    /**
     * Product GDA Values
     *
     * @var Gda[]
     */
    protected $_gdas = [];

    /**
     * Product Nutrition Values
     *
     * @var Nutrition[]
     */
    protected $_nutrition = [];

    /**
     * Product Ingredients
     *
     * @var array
     */
    protected $_ingredients = [];

    /**
     * @inheritDoc
     *
     * @var array
     */
    protected $_dataMap = [
        'gtin' => 'gtin',
        'tpnb' => 'tpnb',
        'tpnc' => 'tpnc',
        'description' => 'description',
        'brand' => 'brand',
        'qtyContents.quantity' => 'quantity',
        'qtyContents.totalQuantity' => 'totalQuantity',
        'qtyContents.quantityUom' => 'unitOfMeasure',
        'qtyContents.netContents' => 'netContents',
        'qtyContents.avgMeasure' => 'averageMeasure',
        'productCharacteristics.isFood' => 'setIsFood',
        'productCharacteristics.isDrink' => 'setIsDrink',
        'productCharacteristics.isHazardous' => 'setIsHazardous',
        'productCharacteristics.storageType' => 'storageType',
        'productCharacteristics.isNonLiquidAnalgesic' => 'setIsNonLiquidAnalgesic',
        'productCharacteristics.containsLoperamide' => 'setContainsLoperamide',
        'pkgDimensions.0.width' => 'width',
        'pkgDimensions.0.height' => 'height',
        'pkgDimensions.0.depth' => 'depth',
        'pkgDimensions.0.dimensionUom' => 'dimensionUnitOfMeasure',
        'pkgDimensions.0.weight' => 'weight',
        'pkgDimensions.0.weightUom' => 'weightUnitOfMeasure',
        'pkgDimensions.0.volume' => 'volume',
        'pkgDimensions.0.volumeUom' => 'volumeUnitOfMeasure',
        'ingredients' => 'ingredients',
        'gda.gdaRefs.values' => 'setGdaReferences',
        'calcNutrition.calcNutrients' => 'setNutritionValues'
    ];

    /**
     * Connstructor for new Product Information
     *
     * @param array $dataset Data from the API response
     */
    public function __construct(array $dataset)
    {
        parent::__construct($dataset);
    }

    /**
     * Set Product isFood value
     *
     * @param boolean $value
     * @return void
     */
    protected function setIsFood(bool $value): void
    {
        $this->_isFood = $value;
    }

    /**
     * Set Product isDrink value
     *
     * @param boolean $value
     * @return void
     */
    protected function setIsDrink(bool $value): void
    {
        $this->_isDrink = $value;
    }

    /**
     * Set product isHazardous value
     *
     * @param boolean $value
     * @return void
     */
    protected function setIsHazardous(bool $value): void
    {
        $this->_isHazardous = $value;
    }

    /**
     * Set Product isNonLiquidAnalgesic value
     *
     * @param boolean $value
     * @return void
     */
    protected function setIsNonLiquidAnalgesic(bool $value): void
    {
        $this->_isNonLiquidAnalgesic = $value;
    }

    /**
     * Set Product containsLoperamide value
     *
     * @param boolean $value
     * @return void
     */
    protected function setContainsLoperamide(bool $value): void
    {
        $this->_containsLoperamide = $value;
    }

    /**
     * Set Product GDAs
     *
     * @param array $references
     * @return void
     */
    protected function setGdaReferences(array $references): void
    {
        foreach ($references as $gda) {
            $this->_gdas[] = new Gda($gda);
        }
    }

    /**
     * Set Product Nutrition values
     *
     * @param array $values
     * @return void
     */
    protected function setNutritionValues(array $values): void
    {
        foreach ($values as $value) {
            $this->_nutrition[] = new Nutrition($value);
        }
    }

    /**
     * Get Product GTIN Number
     *
     * @return string
     */
    public function getGtinNumber(): string
    {
        return $this->_gtin;
    }

    /**
     * Get Product TPNB Number
     *
     * @return string
     */
    public function getTpnbNumber(): string
    {
        return $this->_tpnb;
    }

    /**
     * Get Product TPNC Number
     *
     * @return string
     */
    public function getTpncNumber(): string
    {
        return $this->_tpnc;
    }

    /**
     * Get Product Description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->_description;
    }

    /**
     * Get Product Brand name
     *
     * @return string
     */
    public function getBrand(): string
    {
        return $this->_brand;
    }

    /**
     * Get Product Quantity
     *
     * @return integer
     */
    public function getQuantity(): int
    {
        return $this->_quantity;
    }

    /**
     * Get Product Total Quantity
     *
     * @return integer
     */
    public function getTotalQuantity(): int
    {
        return $this->_totalQuantity;
    }

    /**
     * Get Quantity Unit of Measure
     *
     * @return string
     */
    public function getUnitOfMeasure(): string
    {
        return $this->_unitOfMeasure;
    }

    /**
     * Get Product Net Contents
     *
     * @return string
     */
    public function getNetContents(): string
    {
        return $this->_netContents;
    }

    /**
     * Get Product Average Measure
     *
     * @return string
     */
    public function getAverageMeasure(): ?string
    {
        return $this->_averageMeasure;
    }

    /**
     * Is this Product a Food item?
     *
     * @return boolean
     */
    public function isFood(): bool
    {
        return $this->_isFood;
    }

    /**
     * Is this Product a Drink item?
     *
     * @return boolean
     */
    public function isDrink(): bool
    {
        return $this->_isDrink;
    }

    /**
     * Is this Product Hazardous?
     *
     * @return boolean
     */
    public function isHazardous(): bool
    {
        return $this->_isHazardous;
    }

    /**
     * Is this Product Non Liquid Analgesic?
     *
     * @return boolean
     */
    public function isNonLiquidAnalgesic(): bool
    {
        return $this->_isNonLiquidAnalgesic;
    }

    /**
     * Get Product Storage Type
     *
     * @return string
     */
    public function getStorageType(): string
    {
        return $this->_storageType;
    }

    /**
     * Does this Product contain Loperamide?
     *
     * @return boolean
     */
    public function containsLoperamide(): bool
    {
        return $this->_containsLoperamide;
    }

    /**
     * Get Product Width
     *
     * @return float
     */
    public function getWidth(): float
    {
        return $this->_width;
    }

    /**
     * Get Product Height
     *
     * @return float
     */
    public function getHeight(): float
    {
        return $this->_height;
    }

    /**
     * Get Produtc Depth
     *
     * @return float
     */
    public function getDepth(): float
    {
        return $this->_depth;
    }

    /**
     * Get the Dimension Unit of Measurement
     *
     * @return string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getDimensionMeasurement(): string
    {
        return $this->_dimensionUnitOfMeasure;
    }

    /**
     * Get Product Width with Measurement
     *
     * @return string
     */
    public function getWidthWithMeasurement(): string
    {
        return $this->getWidth() . $this->getDimensionMeasurement();
    }

    /**
     * Get Product Height with Measurement
     *
     * @return string
     */
    public function getHeightWithMeasurement(): string
    {
        return $this->getHeight() . $this->getDimensionMeasurement();
    }

    /**
     * Get Product Depth with Measurement
     *
     * @return string
     */
    public function getDepthWithMeasurement(): string
    {
        return $this->getDepth() . $this->getDimensionMeasurement();
    }

    /**
     * Get Product Dimensions as a string
     * W{width}xH{height}xD{depth}{measurement} => eg W12xH15xD27cm
     *
     * @return string
     */
    public function getDimensionsString(): string
    {
        return "W{$this->_width}xH{$this->_height}xD{$this->_depth}{$this->_dimensionUnitOfMeasure}";
    }

    /**
     * Get Product Weight
     *
     * @return float
     */
    public function getWeight(): float
    {
        return $this->_weight;
    }

    /**
     * Get the Weight Unit of Measurement
     *
     * @return string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getWeightMeasurement(): string
    {
        return $this->_weightUnitOfMeasure;
    }

    /**
     * Get Product Volume
     *
     * @return float
     */
    public function getVolume(): float
    {
        return $this->_volume;
    }

    /**
     * Get the Volume Unit of Measurement
     *
     * @return string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function getVolumeMeasurement(): string
    {
        return $this->_volumeUnitOfMeasure;
    }

    /**
     * Get Product Weight with Measurement
     *
     * @return string
     */
    public function getWeightWithMeasurement(): string
    {
        return $this->getWeight() . $this->getWeightMeasurement();
    }

    /**
     * Get Product Volume with Measurement
     *
     * @return string
     */
    public function getVolumeWithMeasurement(): string
    {
        return $this->getVolume() . $this->getVolumeMeasurement();
    }

    /**
     * Get Product GDAs
     *
     * @return array
     */
    public function getGdas(): array
    {
        return $this->_gdas;
    }

    /**
     * Get Product Nutrition values
     *
     * @return array
     */
    public function getNutrition(): array
    {
        return $this->_nutrition;
    }

    /**
     * Get Product Ingredients
     *
     * @return array
     */
    public function getIngredients(): array
    {
        return $this->_ingredients;
    }
}
