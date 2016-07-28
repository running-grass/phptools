<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Figure\Point;
use \Leo\Figure\Line;
use \Leo\Figure\Angle;

$p = new Point(0,0);
$p1 = new Point(5,5);

$l = new Line($p, $p1);

$p1 = new Point(5,5);
$p11 = new Point(0,10);

$l1 = new Line($p1, $p11);

$a = new Angle($l, $l1);

echo "$a\n";