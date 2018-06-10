<?php

namespace ImClarky\TescoApi\Models;

abstract class AbstractModel
{
    protected $_dataMap = [];

    public function __construct(array $dataset)
    {
        $this->mapData($dataset);
    }

    protected function mapData($dataset)
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
