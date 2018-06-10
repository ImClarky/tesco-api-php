<?php

namespace ImClarky\TescoApi\Responses;

abstract class AbstractResponse
{
    protected $_rawHeaders;
    protected $_headers = [];
    protected $_rawData;
    protected $_data;
    protected $_statusCode;
    protected $_statusMessage;
    protected $_models = [];

    const STATUS_REGEX = '/HTTP\/(?:1\.1|2) ([\d]{3}) ([\w]+)/';

    public function __construct(string $responseData)
    {
        $data = explode(PHP_EOL . PHP_EOL, $responseData);
        $this->_rawHeaders = $data[0];
        $this->_rawData = $data[1];

        $this->_data = json_decode($this->_rawData, true);

        $this->setStatus($this->_rawHeaders);
        $this->setHeaders($this->_rawHeaders);
        $this->populateModels();
    }

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

    protected function setStatus($headers)
    {
        preg_match(self::STATUS_REGEX, $headers, $matches);

        $this->_statusCode = $matches[1];
        $this->_statusMessage = $matches[2];
    }

    protected abstract function populateModels();
}
