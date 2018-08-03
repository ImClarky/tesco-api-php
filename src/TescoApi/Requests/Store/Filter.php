<?php

namespace ImClarky\TescoApi\Requests\Store;

use ImClarky\TescoApi\Requests\Store\AbstractFilterable;

/**
 * Store Filter class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class Filter extends AbstractFilterable
{
    /**
     * The query sting paramter key
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public static $_queryName = 'filter';

    /**
     * Add an option to the filters
     *
     * @param string $type
     * @param mixed $value
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addOption(string $type, $value): self
    {
        if (array_key_exists($type, $this->_filters)) {
            $this->_filters[$type][] = $value;
        } else {
            $this->_filters[$type] = [$value];
        }

        return $this;
    }
}
