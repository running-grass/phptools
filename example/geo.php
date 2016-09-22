<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Geo;

try {
    $lib_geo = new Geo();
    $res = $lib_geo->get_gaode_area('花家地西里一区', '北京市');
    var_dump($res);
} catch (\Exception $e) {
    echo $e->getMessage();
}