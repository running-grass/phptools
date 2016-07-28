<?php
namespace Leo\Figure;

// 点类
class Point
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

    public function __string()
    {
        try {
            return "{$this->x},{$this->y}";
        } catch (\Exception $e) {
            throw $e;
        }
    }
}