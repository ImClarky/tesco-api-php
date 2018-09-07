<?php

namespace ImClarky\TescoApi\Requests;

use ImClarky\TescoApi\Exceptions\RequestException;
use ImClarky\TescoApi\Responses\AbstractResponse;

/**
 * Abstract Request Class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
abstract class AbstractRequest
{
    /**
     * API Key
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_apiKey;

    /**
     * The API uri endpoint
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_uri = '/';

    /**
     * Query string holding our request params
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_queryString;

    /**
     * The cURL resource
     *
     * @var resource
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_curl;

    /**
     * Response from curl_exec
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_result;

    /**
     * The base url of the API
     */
    const BASEURL = "https://dev.tescolabs.com";

    /**
     * Request constructor
     *
     * @param string $apiKey
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function __construct(string $apiKey)
    {
        if (empty($apiKey)) {
            throw new RequestException('No API key was provided');
        }
        $this->_apiKey = $apiKey;
        $this->_curl = curl_init();
    }

    /**
     * Send our API request
     *
     * @return AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function send(): AbstractResponse
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

    /**
     * Set the cURL options of our request
     *
     * @return void
     * @author Sean Clark <sean.clark@d3r.com>
     */
    private function setCurlOptions(): void
    {
        $options = [
            CURLOPT_URL => $this->getRequestUri(),
            CURLOPT_HTTPHEADER => [
                'Ocp-Apim-Subscription-Key: ' . $this->_apiKey,
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => true,
            CURLOPT_ENCODING => 'gzip',
        ];

        curl_setopt_array($this->_curl, $options);
    }

    /**
     * Get the full request url
     *
     * @return string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    private function getRequestUri(): string
    {
        return static::BASEURL . $this->_uri . $this->_queryString;
    }

    /**
     * Build the query string
     *
     * @return void
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected abstract function buildQueryString(): void;

    /**
     * Resolve the response from the cURL request to a Response object
     *
     * @return AbstractResponse
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected abstract function resolveResponse(): AbstractResponse;
}
