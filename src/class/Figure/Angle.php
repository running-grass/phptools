<?php
namespace Leo\Figure;

use \Leo\Figure\Point;
use \Leo\Figure\Line;

// 角度类
class Angle
{
    private $l1;
    private $l2;
    private $p;

    public function __construct(Line $l1, Point $p, Line $l2)
    {
        try {
            $this->setP1($p1);
            $this->setP2($p2);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    public function setL1(Line $l1)
    {
        try {
            $this->l1 = $l1;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getL1()
    {
        try {
            return $this->l1;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    public function setP(Point $p)
    {
        try {
            $this->p = $p;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getP()
    {
        try {
            return $this->p;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    public function setL2(Line $l1)
    {
        try {
            $this->l2 = $l2;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getL2()
    {
        try {
            return $this->l2;
        } catch (\Exception $e) {
            throw $e;
        }
    }


}