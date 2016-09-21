<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;

try {
    $lib_geo = new Geo();
    $res = $lib_geo->getGaodeCityareaBorder('道里区', '哈尔滨市');
    var_dump($res);
} catch (\Exception $e) {
    echo $e->getMessage();
}