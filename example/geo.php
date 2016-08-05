<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;

$geo = new Geo();
$arr = $geo->getBaiduSubways('天津市');

echo json_encode($arr);