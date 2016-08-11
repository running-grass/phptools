<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;

try {
    $lib_geo = new Geo();

    $a = $lib_geo->getBaiduBusStops('571', '北京市');
    $gs = [
        $a['stops'][22]['loc'],
        $a['stops'][21]['loc'],
    ];

    $l = $lib_geo->getDistance($gs[0], $gs[1]);
    echo $l ;
    foreach (range(1, 10000) as $v) {
        $b = $lib_geo->getBaiduWalkDis($gs);
        var_dump("[{$v}]  {$b}");
    }

} catch (\Exception $e) {
    echo $e->getMessage();
}