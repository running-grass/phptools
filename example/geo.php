<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;
$lib_geo = new Geo();

$a = $lib_geo->getBaiduBusStops('通44', '北京市');

$l = $lib_geo->getDistance($a['stops'][0]['loc'], $a['stops'][13]['loc']);
var_dump($l);