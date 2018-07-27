<?php

namespace ImClarky\TescoApi\Requests\Store;

use ImClarky\TescoApi\Requests\Store\AbstractFilterable;

/**
 * Store Like Filter Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class Like extends AbstractFilterable
{
    /**
     * The query sting paramter key
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public static $_queryName = 'like';

    /**
     * Add an option to the filters
     *
     * @param string $type
     * @param mixed $value
     * @param boolean $start
     * @return ImClarky\TescoApi\Requests\AbstractRequest
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addOption(string $type, $value, bool $start = false)
    {
        if (array_key_exists($type, $this->_filters)) {
            $this->_filters[$type][] = $this->makeFilterValue($value, $start);
        } else {
            $this->_filters[$type] = [$this->makeFilterValue($value, $start)];
        }

        return $this;
    }

    /**
     * Add a caret (^) to the start of the string values
     * if the search value should be at the start
     *
     * @param mixed $value
     * @param boolean $isStart
     * @return string|string[]
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function makeFilterValue($value, bool $isStart)
    {
        if (is_array($value)) {
            if ($isStart) {
                array_walk($value, function(&$filter) {
                    $filter = '^' . $filter;
                });
            }

            return $value;
        } else {
            return $isStart
                ? '^' . $value
                : $value;
        }
    }
}
