<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;

try {
    $lib_geo = new Geo();
    $res = $lib_geo->getBaiduGeo2('门头沟其它', '北京市');
    var_dump($res);
} catch (\Exception $e) {
    echo $e->getMessage();
}