<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;

$geo = new Geo();
$arr = $geo->getBaiduSubwayStops('北京市');

echo json_encode($arr);