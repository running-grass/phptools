<?php
namespace Leo\Figure;

// 点类
class Point
{
    private $x;
    private $y;

    // setting and  getting
    public function setX($x)
    {
        try {
            $this->x = (float)$x;
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