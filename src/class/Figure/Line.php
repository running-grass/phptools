<?php
namespace Leo\Figure;

use \Leo\Figure\Point;

// 线段类
class Line
{
    private $p1;
    private $p2;

    public function __construct(Point $p1, Point $p2)
    {
        try {
            $this->setP1($p1);
            $this->setP2($p2);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    public function setP1(Point $p1)
    {
        try {
            $this->p1 = $p1;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getP1()
    {
        try {
            return $this->p1;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    public function setP2(Point $p2)
    {
        try {
            $this->p2 = $p2;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getP2()
    {
        try {
            return $this->p2;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}