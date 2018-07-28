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
    const FILTERABLE_NAME = 'name';
    const FILTERABLE_BRANCHNUMBER = 'branchNumber';
    const FILTERABLE_ISOCOUNTRYCODE = 'isoCountryCode';
    const FILTERABLE_FACILITY = 'facilities';
    const FILTERABLE_CATEGORY = 'category';
    const FILTERABLE_TYPE = 'type';
    const FILTERABLE_STATUS = 'status';

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
