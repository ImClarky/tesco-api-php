<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Requests\AbstractRequest;
use ImClarky\TescoApi\Responses\ProductResponse;

/**
 * Product Request Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class ProductRequest extends AbstractRequest
{
    /**
     * The GTIN / EAN13 number of a product
     *
     * @var array
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_gtin = [];

    /**
     * The Tesco Product Number Base Product number
     *
     * @var array
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_tpnb = [];

    /**
     * The Tesco Product Number Consumer unit number
     *
     * @var array
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_tpnc = [];

    /**
     * The Catalogue number of a product
     *
     * @var array
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_catId = [];

    /**
    * @inheritDoc
     */
    protected $_uri = '/product';

    /**
     * @inheritDoc
     */
    public function __construct(string $apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Add a GTIN / EAN13 number to the array
     *
     * @param string $gtin
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addGtin(string $gtin)
    {
        $this->_gtin[] = $gtin;
        return $this;
    }

    /**
     * Add a TPNB number to the array
     *
     * @param string $tnpb
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addTpnb(string $tnpb)
    {
        $this->_tpnb[] = $tnpb;
        return $this;
    }

    /**
     * Add a TPNC number to the array
     *
     * @param string $tpnc
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addTpnc(string $tpnc)
    {
        $this->_tpnc[] = $tpnc;
        return $this;
    }

    /**
     * Add a Catalogue number to the array
     *
     * @param string $catId
     * @return self
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function addCatId(string $catId)
    {
        $this->_catId[] = $catId;
        return $this;
    }

    /**
     * @inheritDoc
     */
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

    /**
     * Create a new Response Instance
     *
     * @return ImClarky\TescoApi\Responses\ProductResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function resolveResponse()
    {
        return new ProductResponse($this->_result);
    }
}
