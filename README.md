# Tesco API - PHP
A

## Getting Started
### Installation
To install, simply require the package using composer:

```bash
composer require imclarky/tesco-api
```
### Requirements
- PHP >7.1
- Tesco API Key (see below)

### API Key
You will first need to register for an API Key from [Tesco's Developer Portal](https://devportal.tescolabs.com/), by signing up for an account and subscribing the General APIs.

### Simple Example
Here is a simple example of a request to the Tesco API to find grocerys related to the word _chocolate_:

```php
$tesco = new \ImClarky\TescoApi\TescoApi('ReallyLongApiKey1234567890');

$results = $tesco->newGroceryRequest()->addSearchTerm('chocolate')->send();

foreach ($results->getModels() as $grocery) {
    echo $grocery->getName();
}
```
