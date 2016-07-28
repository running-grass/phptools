<?php
namespace Leo\Figure;

use \Leo\Base;

// 点类
class Point extends Base
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        try {
            $this->setX($x);
            $this->setY($y);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    private function setX($x)
    {
        try {
            $this->x = (double)$x;
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
    private function setY($y)
    {
        try {
            $this->y = (double)$y;
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