<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;

try {
    $lib_geo = new Geo();

    $a = $lib_geo->getBaiduBusStops('571', '北京市');


    $l = $lib_geo->getRectByGeo($a['stops'][20]['loc'], 1);

    // var_dump($a);die;

    $a = $lib_geo->getBaiduNearby('公园', $l, '北京市');

    var_dump($a);
} catch (\Exception $e) {
    echo $e->getMessage();
}