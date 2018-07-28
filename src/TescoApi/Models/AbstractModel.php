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
     * @param [type] $dataset
     * @return void
     */
    protected function mapData(array $dataset): void
    {
        foreach ($dataset as $key => $value) {
            if (is_array($value)) {
                $this->mapData($value);
            }

            if (isset($this->_dataMap[$key])) {
                if (method_exists($this, $this->_dataMap[$key])) {
                    $this->{$this->_dataMap[$key]}($value);
                } elseif (property_exists($this, '_' . $this->_dataMap[$key])) {
                    $this->{'_' . $this->_dataMap[$key]} = $value;
                }
            }
        }
    }
}
