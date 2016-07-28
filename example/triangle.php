<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Figure\Point;
use \Leo\Figure\Line;
use \Leo\Figure\Triangle;

$p = new Point(0,0);
$p1 = new Point(5,0);
$p2 = new Point(5,5);

$a = new Triangle($p, $p1, $p2);

$a->getLines();
$a->getAngles();

echo "$a\n";