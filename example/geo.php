<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;

try {
    $lib_geo = new Geo();
    $res = $lib_geo->getBaiduCityareaBorder('高淳', '南京市');
    $res = $lib_geo->getBaiduGeo2('高淳', '南京市');
    var_dump($res);
} catch (\Exception $e) {
    echo $e->getMessage();
}