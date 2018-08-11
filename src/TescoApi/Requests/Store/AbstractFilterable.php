<?php

namespace ImClarky\TescoApi\Requests\Store;

/**
 * Abstract Filterable Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
abstract class AbstractFilterable
{
    /**
     * Search Filters
     *
     * @var array
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_filters = [];

    /**
     * Filters
     */
    const FILTER_NAME = 'name';
    const FILTER_BRANCHNUMBER = 'branchNumber';
    const FILTER_ISOCOUNTRYCODE = 'isoCountryCode';
    const FILTER_FACILITY = 'facilities';
    const FILTER_CATEGORY = 'category';
    const FILTER_TYPE = 'type';
    const FILTER_STATUS = 'status';

    /**
     * Build the query parameter string
     *
     * @return string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function buildQuerySegment(): string
    {
        $params = [];
        foreach ($this->_filters as $filter => $values) {
            foreach ($values as $value) {
                $params[] = $filter . ":" . (is_array($value) ? implode(",", $value) : $value);
            }
        }

        return implode(" AND ", $params);
    }
}
