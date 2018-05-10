<?php

namespace ImClarky\TescoApi;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Request as HttpRequest;

abstract class Request
{
    protected $_client;
    protected $_apiKey;
    protected $_uri;
    protected $_queryString;

    const BASEURL = "https://dev.tescolabs.com";
    const METHOD = 'GET';

    public function __construct($apiKey)
    {
        $this->_client = new Client(static::BASEURL);
        $this->_apiKey = $apiKey;
    }

    public function send() {
        $request = new HttpRequest(static::METHOD, $this->buildQueryString(), [
            'Ocp-Apim-Subscription-Key' => $this->_apiKey
        ]);

        $this->_client->send($request);
    }

    abstract function buildQueryString();

}
