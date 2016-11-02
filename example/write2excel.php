<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

try {
    $arr = [
        [
            'a' => 1,
            'b' => 2
        ],[
            '121313',23432432,23432432
        ],[
            'dsfsafds'
        ]
    ];

    // echo 111;
    \Leo\File::arrSaveCsv($arr, 'aaaaaaaaaa');

} catch (\Exception $e) {
    echo $e->getMessage();
}