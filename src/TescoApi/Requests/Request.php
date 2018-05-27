<?php

namespace ImClarky\TescoApi\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as HttpRequest;

abstract class Request
{
    protected $_client;
    protected $_apiKey;
    protected $_uri;
    protected $_queryString = '?';
    protected $_result;

    const BASEURL = "https://dev.tescolabs.com";
    const METHOD = 'GET';

    public function __construct(string $apiKey)
    {
        $this->_client = new Client([
            'base_url' => static::BASEURL
        ]);
        $this->_apiKey = $apiKey;
    }

    public function send() {
        $this->buildQueryString();

        $request = new HttpRequest(static::METHOD, $this->getFullUri(), [
            'Ocp-Apim-Subscription-Key' => $this->_apiKey,
            'debug' => true
        ]);

        $response = $this->_client->send($request);

        $this->_result = json_decode($response->getBody(), true);
    }

    protected function getFullUri()
    {
        return static::BASEURL . $this->_uri . $this->_queryString;
    }

    abstract protected function buildQueryString();
    abstract public function resolveResponse();
}
