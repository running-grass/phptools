<?php
require_once __DIR__ . '/../autoload.php';

use \Leo\Figure\Point;
use \Leo\Figure\Line;

$p = new Point(0,0);
$p1 = new Point(5,5);

$l = new Line($p, $p1);

echo "$l\n";