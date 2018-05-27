<?php

use ImClarky\TescoApi\TescoApi;

define('ROOT', dirname(dirname(__FILE__)));
include(ROOT . '/vendor/autoload.php');

$apikey = 'fca1666fa85a4b629a2c56533ea74395';

$tesco = new TescoApi($apikey);

$request = $tesco->newProductRequest();

$request->addTpnb(54773661)
        ->send();

var_dump($request->resolveResponse());

exit;
