<?php

namespace ImClarky\TescoApi\Responses;

/**
 * Abstract Response Class
 */
abstract class AbstractResponse
{
    /**
     * Raw text value of HTTP Response Headers
     *
     * @var string
     */
    protected $_rawHeaders;

    /**
     * Key Value Pairing of HTTP Response Headers
     *
     * @var array
     */
    protected $_headers = [];

    /**
     * Raw text value of response body
     *
     * @var string
     */
    protected $_rawData;

    /**
     * JSON decoded response body
     *
     * @var array
     */
    protected $_data;

    /**
     * HTTP Status Code
     *
     * @var integer
     */
    protected $_statusCode;

    /**
     * HTTP Status Message
     *
     * @var string
     */
    protected $_statusMessage;

    /**
     * Response Models
     *
     * @var array
     */
    protected $_models = [];

    const STATUS_REGEX = '/HTTP\/(?:1\.1|2) ([\d]{3}) ([\w]+)/';

    /**
     * Response Constructor
     *
     * @param string $responseData
     */
    public function __construct(string $responseData)
    {
        $data = preg_split("/\r\n\r\n|\n\n|\r\r/", $responseData);
        $this->_rawHeaders = $data[0];
        $this->_rawData = $data[1];

        $this->_data = json_decode($this->_rawData, true);

        $this->setStatus($this->_rawHeaders);
        $this->setHeaders($this->_rawHeaders);
        $this->populateModels();
    }

    /**
     * Set the headers from the raw values
     *
     * @param string $headers
     * @return void
     */
    protected function setHeaders($headers)
    {
        $lines = explode(PHP_EOL, $headers);

        foreach ($lines as $line) {
            if (strpos($line, ':') !== false) {
                $header = explode(':', $line);
                $key = $header[0];

                if (array_key_exists($key, $this->_headers)) {
                    $this->_headers[$key][] = trim($header[1]);
                } else {
                    $this->_headers[$key] = [
                        trim($header[1])
                    ];
                }
            }
        }
    }

    /**
     * Set the HTTP Status Code and Message
     *
     * @param string $headers
     * @return void
     */
    protected function setStatus($headers)
    {
        preg_match(self::STATUS_REGEX, $headers, $matches);

        $this->_statusCode = $matches[1];
        $this->_statusMessage = $matches[2];
    }

    /**
     * Get the HTTP Status Code
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    /**
     * Get the HTTP Status message
     *
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->_statusMessage;
    }

    /**
     * Get the models created by the response
     *
     * @return array
     */
    public function getModels()
    {
        return $this->_models;
    }

    /**
     * Generate the Models from the repsonse data
     *
     * @return void
     */
    protected abstract function populateModels();
}
