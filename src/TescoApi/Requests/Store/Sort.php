<?php

namespace ImClarky\TescoApi\Requests\Store;

class Sort
{
    public static $_queryName = 'sort';

    protected $_filters = [];

    const SORT_NEAR = 'near';

    public function addOption(string $type, string $value): self
    {
        if (array_key_exists($type, $this->_filters)) {
            $this->_filters[$type][] = $value;
        } else {
            $this->_filters[$type] = [$value];
        }
    }

    public function buildQuerySegment(): string
    {
        $params = [];
        foreach ($this->_filters as $filter => $values) {
            foreach ($values as $value) {
                $params[] = $filter . ":\"" . (is_array($value) ? implode(",", $value) : $value) . "\"";
            }
        }

        return implode(" AND ", $params);
    }
}
