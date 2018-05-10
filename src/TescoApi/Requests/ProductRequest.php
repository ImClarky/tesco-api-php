<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Request;

class ProductRequest extends Request
{
    protected $_gtin = [];
    protected $_tpnb = [];
    protected $_tnpc = [];
    protected $_catId = [];

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
}
