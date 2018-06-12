<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Exceptions\RequestException;
use ImClarky\TescoApi\Responses\AbstractResponse;

abstract class AbstractRequest
{
    protected $_apiKey;
    protected $_uri = '/';
    protected $_queryString = '?';
    protected $_curl;
    protected $_result;

    const BASEURL = "https://dev.tescolabs.com";

    public function __construct(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new RequestException('No API key was provided');
        }
        $this->_apiKey = $apiKey;
        $this->_curl = curl_init();
    }

    public function send()
    {
        $this->buildQueryString();
        $this->setCurlOptions();

        $this->_result = curl_exec($this->_curl);

        if (!$this->_result && !empty(curl_error($this->_curl))) {
            throw new RequestException(
                curl_error($this->_curl),
                curl_errno($this->_curl)
            );
        }

        return $this->resolveResponse();
    }

    private function setCurlOptions()
    {
        $options = [
            CURLOPT_URL => $this->getRequestUri(),
            CURLOPT_HTTPHEADER => [
                'Ocp-Apim-Subscription-Key: ' . $this->_apiKey,
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => true,
        ];

        curl_setopt_array($this->_curl, $options);
    }

    private function getRequestUri()
    {
        return static::BASEURL . $this->_uri . $this->_queryString;
    }

    protected abstract function buildQueryString();
    protected abstract function resolveResponse();
}
