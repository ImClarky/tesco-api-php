<?php

namespace ImClarky\TescoApi\Models;

/**
 * Abstract Model Class
 */
abstract class AbstractModel
{
    /**
     * Map of Data point to Variable
     *
     * @var array
     */
    protected $_dataMap = [];

    /**
     * Model Constructor
     *
     * @param array $dataset
     */
    public function __construct(array $dataset)
    {
        $this->mapData($dataset);
    }

    /**
     * Map Datapoints to Variables
     *
     * @param array $dataset
     * @return void
     */
    protected function mapData(array $dataset): void
    {
        foreach ($this->_dataMap as $pointer => $property) {
            $value = $this->getDataSetValue($pointer, $dataset);

            if (!is_null($value)) {
                if (method_exists($this, $property)) {
                    $this->{$property}($value);
                } elseif (property_exists($this, '_' . $property)) {
                    $this->{'_' . $property} = $value;
                }
            }
        }
    }

    /**
     * Find the value from the dataset for a given pointer
     *
     * @param string $pointer
     * @param array $dataset
     * @return mixed
     */
    protected function getDataSetValue($pointer, $dataset)
    {
        $value = $dataset;
        $keys = explode('.', $pointer);

        foreach ($keys as $key) {
            if ( array_key_exists($key, $value)) {
                $value = $value[$key];
            } else {
                $value = null;
                break;
            }
        }

        return $value;
    }
}
