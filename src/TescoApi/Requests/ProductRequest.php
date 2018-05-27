<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Requests\Request;
use ImClarky\TescoApi\Models\Product;

class ProductRequest extends Request
{
    protected $_gtin = [];
    protected $_tpnb = [];
    protected $_tpnc = [];
    protected $_catId = [];

    protected $_uri = '/product';

    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }

    public function addGtin(string $gtin)
    {
        $this->_gtin[] = $gtin;
        return $this;
    }

    public function addTpnb(string $tnpb)
    {
        $this->_tpnb[] = $tnpb;
        return $this;
    }

    public function addTpnc(string $tpnc)
    {
        $this->_tpnc[] = $tpnc;
        return $this;
    }

    public function addCatId(string $catId)
    {
        $this->_catId[] = $catId;
        return $this;
    }

    protected function buildQueryString()
    {
        $typeList = [
            'gtin' => $this->_gtin,
            'tpnb' => $this->_tpnb,
            'tpnc' => $this->_tpnc,
            'catid' => $this->_catId,
        ];

        $params = [];

        foreach ($typeList as $type => $codes) {
            if (empty($codes)) {
                continue;
            }

            foreach ($codes as $code) {
                $params[] = $type . '=' . $code;
            }
        }

        $this->_queryString .= implode('&', $params);
    }

    public function resolveResponse()
    {
        var_dump($this->_result);

        $resultset = [];

        foreach ($this->_result->products as $product) {
            $resultset = new Product($product);
        }

        return $resultset;
    }
}
