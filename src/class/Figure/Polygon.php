<?php
namespace Leo\Figure;

use \Leo\Figure\Point;
use \Leo\Figure\Line;

// 线段类
class Polygon
{
    private $arr_p;
    private $arr_l;

    public function __construct(array $arr_p)
    {
        try {
            $this->setP1($p1);
            $this->setP2($p2);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}