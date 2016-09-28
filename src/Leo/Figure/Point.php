<?php
namespace Leo\Figure;

use \Leo\Base;

// 点类
class Point extends Base
{
    private $x; // x坐标
    private $y; // y 坐标

    public function __construct($x, $y)
    {
        try {
            $this->setX($x);
            $this->setY($y);

            unset($x, $y);
            return 0;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    public function setX($x)
    {
        try {
            $this->x = (float)$x;

            unset($x);
            return 0;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getX()
    {
        try {
            return $this->x;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    public function setY($y)
    {
        try {
            $this->y = (float)$y;

            unset($y);
            return 0;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getY()
    {
        try {
            return $this->y;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function __toString()
    {
        try {
            return "({$this->getX()},{$this->getY()})";
        } catch (\Exception $e) {
            throw $e;
        }
    }

}