<?php

namespace ImClarky\TescoApi;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Request as HttpRequest;

abstract class Request
{
    protected $_client;
    protected $_apiKey;
    protected $_uri;
    protected $_queryString = '?';
    protected $_result;

    const BASEURL = "https://dev.tescolabs.com/";
    const METHOD = 'GET';

    public function __construct($apiKey)
    {
        $this->_client = new Client(static::BASEURL);
        $this->_apiKey = $apiKey;
    }

    public function send() {
        $this->buildQueryString();

        $request = new HttpRequest(static::METHOD, $this->_queryString, [
            'Ocp-Apim-Subscription-Key' => $this->_apiKey
        ]);

        $response = $this->_client->send($request);

        $this->_result = json_decode($response->getData());
    }

    abstract protected function buildQueryString();
    abstract protected function resolveResponse();
}
