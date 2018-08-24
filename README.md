# Tesco API - PHP
A PHP Client for the Tesco Supermarket API

[![Packagist](https://img.shields.io/packagist/v/Imclarky/tesco-api.svg)](https://packagist.org/packages/imclarky/tesco-api)
[![Packagist Pre Release](https://img.shields.io/packagist/vpre/Imclarky/tesco-api.svg)](https://packagist.org/packages/imclarky/tesco-api)
[![Build Status](https://travis-ci.org/ImClarky/tesco-api-php.svg?branch=master)](https://travis-ci.org/ImClarky/tesco-api-php)
[![Coverage Status](https://coveralls.io/repos/github/ImClarky/tesco-api-php/badge.svg?branch=master)](https://coveralls.io/github/ImClarky/tesco-api-php?branch=master)

## Contents
- [Getting Started](#getting-started)
    - [Installation](#installation)
    - [Requirements](#requirements)
    - [API Key](#api-key)
    - [Simple Example](#simple-example)
- [Usage](#usage)
    - [Requests](#requests)
        - [Grocery Request](#grocery-request)
        - [Product Request](#product-request)
        - [Store Location Request](#store-location-request)
    - [Responses](#responses)
    - [Models](#models)

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
$tesco = new \ImClarky\TescoApi\TescoApi('apikey');

$results = $tesco->newGroceryRequest()->addSearchTerm('chocolate')->send();

foreach ($results->getModels() as $grocery) {
    echo $grocery->getName();
}
```

## Usage
### Requests
There are two ways of creating requests to the API. The first, as shown above, is to use the base TescoApi class.

The base class is initialized with your API Key:

```php
$tescoApi = new \ImClarky\TescoApi\TescoApi('apikey');
```


This base class has 3 main functions, each of which will return a new instance of the related request class.

```php
public function newGroceryRequest(): GroceryRequest
{
    return new GroceryRequest($this->_apiKey);
}

public function newProductRequest(): ProductRequest
{
    return new ProductRequest($this->_apiKey);
}

public function newStoreLocationRequest(): StoreLocationRequest
{
    return new StoreLocationRequest($this->_apiKey);
}
```

Alternatively you can create new instances of the Request classes directly, again passing the API key asa a parameter.

```php
$groceryRequest = new \ImClarky\TescoApi\Requests\GroceryRequest('apikey');

$productRequest = new \ImClarky\TescoApi\Requests\ProductRequest('apikey');

$storeLocationRequest = new \ImClarky\TescoApi\Requests\StoreLocationRequest('apikey');
```

Each request object has different methods to add query paramters to the API request.

#### Grocery Request
**`addSearchTerm(string $searchTerm)`**<br>
Add a search term to search for. Providing a search term is required; if no term is added when the request is sent, the Request class will throw a `RequestException`.

```php
$request = new GroceryRequest('apikey');

$response = $request->addSearchTerm('biscuits')->send();
```

#### Product Request
**`addGtin(string $gtin)`**<br>
Add a product's GTIN/EAN-13 number to the search list.

**`addTpnb(string $tpnb)`**<br>
Add a product's Tesco Product Number Base (TPNB) number to the search list.

**`addTpnc(string $tpnc)`**<br>
Add a product's Tesco Product Number Consumer (TPNC) number to the search list.

**`addCatId(string $catId)`**<br>
Add a product's Catalogue ID to the search list.

Each of these functions returns the request object instance to allow chaining the above methods.

```php
$request = new ProductRequest('apikey');

$response = $request->addGtin('0332322384993')
                    ->addGtin('0368604930293')
                    ->addTpnc('34029384')
                    ->send();
```

#### Store Location Request
**`addSort(string $type, string $value)`**<br>
Add a Sort query parameter. Currently the only sort type is _Near_; Which sorts the results by distance from the given location.

| Type | Description | Example Values |
| ---- | ---- | ---- |
| SORT_NEAR | Sort the results by the distance from the given location - ascending | London, UK<br>SE11 5AP |

**`addFilter(string $type, $value)`**<br>
Add a Filter query parameter to filter the results.

| Type | Description | Example Values |
| ---- | ---- | ---- |
| FILTER_NAME | The name of the store | Lakeside Extra<br>Charing Cross Express |
| FILTER_BRANCHNUMBER | The branch number of the store | 3482<br>2593 |
| FILTER_ISOCOUNTRYCODE | The ISO Country Code the store is located in | gb<br>x-uk<br>im |
| FILTER_FACILITY | A facility at the store | Facility::FACILITY_ATM<br>Facility::FACILITY_CAR_WASH |
| FILTER_CATEGORY | A store category | Store::CATEGORY_STORE<br>Store::CATEGORY_CFC |
| FILTER_TYPE | A store type | Store::TYPE_EXTRA<br>Store::TYPE_EXPRESS |
| FILTER_STATUS | The status of the store | Trading |

Normally a string will be passed in the `$value` parameter - this will add the term and will be used in a `AND` expression in the where clause. However, if an array is passed, the values of the array will be treated as an `OR` expression. For example:

```php
$response = $storeRequest->addFilter(Filter::FILTER_FACILITY, Facility::FACILITY_ATM)
                         ->addFilter(Filter::FILTER_FACILITY, Facility::FACILITY_DBT)
                         ->addFilter(Filter::FILTER_FACILITY, [
                             Facility::FACILITY_CAR_WASH,
                             Facility::FACILITY_JET_WASH,
                             Facility::FACILITY_HAND_CAR_WASH
                         ]);

// In an SQL-like querying language
// WHERE Facility = 'ATM' AND Facility = 'DBT' AND (Facility = 'Car Wash' OR Facility = 'Jet Wash' OR Facility = 'Hand Car Wash')
```

**`addLike(string $type, $value, bool $start = false)`**<br>
Add a Like query paramter to filter the results. This is exactly the same as Filters, except the API will do a full text search for the the value. If `$start` is set to true, the search will only return results where the term is at the start.

#### Pagination
Both the Store Location and Grocery request results are returned in pages. You can set the offset and limit on these request, as well as navigate the pages.

**`setLimit(int $limit)`**<br>
Set the limit of the request - ie, how many results to return. If this function is never called, then the default value of *10* is used.

**`setOffset(int $offset)`**<br>
Set the offset of the request - ie, how many results to offset. If this function is never called, then the default value of *0* is used.

**`getNextPage()`**<br>
Get the next page of results

**`getPrevPage()`**<br>
Get the previous page of results.

**`goToPage(int $page)`**<br>
Go to a specific page of results.

### Responses

### Models
