<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Arr;

$arr = [
    'a' =>'sdf','b' =>'sdfas','fa' => [34,3]
];
$arr1 = [
    'd'=>'sdfas22','fa' => [3,'sd']
];

$a = Arr::merge_supplement($arr, $arr1);

var_dump($a);