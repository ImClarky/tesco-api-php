<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Request;
use ImClarky\TescoApi\Models\Product;

class ProductRequest extends Request
{
    protected $_gtin = [];
    protected $_tpnb = [];
    protected $_tnpc = [];
    protected $_catId = [];

    protected $uri = 'product';

    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }

    public function addGtin($gtin)
    {
        $this->_gtin[] = $gtin;
        return $this;
    }

    public function addTpnb($tnpb)
    {
        $this->_tpnb[] = $tnpb;
        return $this;
    }

    public function addTpnc($tpnc)
    {
        $this->_tpnc[] = $tpnc;
        return $this;
    }

    public function addCatId($catId)
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

        $this->_queryString .= explode('&', $params);
    }

    protected function resolveResponse()
    {
        $resultset = [];

        foreach ($this->_result->products as $product) {
            $resultset = new Product($product);
        }

        return $resultset;
    }
}
