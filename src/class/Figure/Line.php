<?php
namespace Leo\Figure;

use \Leo\Figure\Point;

// 异常
use \Leo\Figure\Exception\LineOverlapException;
use \Leo\Figure\Exception\TwoPointOverlapException;

// 线段类
class Line
{
    private $p1;
    private $p2;
    private $tilt;

    public function __construct(Point $p1, Point $p2)
    {
        try {
            if ($p1 == $p2) {
                throw new TwoPointOverlapException('两个端点不能重合');
            }
            $this->setP1($p1);
            $this->setP2($p2);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 生成倾斜角
    private function generateTilt()
    {
        try {
            $dy = $this->getP2()->getY() - $this->getP1()->getY();
            $dx = $this->getP2()->getX() - $this->getP1()->getX();
            // dump($this);
            $ang = (rad2deg(atan($dy/$dx)));
            if ($dx > 0 && $dy >= 0) {
                $ext = 0;
            } elseif ($dx <= 0 && $dy >= 0) {
                $ext = 180;
                if (0 == $dx) {
                    $ext = 90;
                }
            } elseif ($dx < 0 && $dy <= 0) {
                $ext = 180;
            } elseif ($dx >= 0 && $dy < 0) {
                $ext = 360;
                if (0 == $dx) {
                    $ext = 270;
                }
            }
            $ang = $ang + $ext;
            $this->setTilt($ang);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 判断点是否在线上
    public function inLine(Point $p)
    {
        try {
            $l1 = new Line($p, $this->getP1());
            $l2 = new Line($p, $this->getP2());
            if (180 == abs($l1->getTilt() - $l2->getTilt())) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    private function setP1(Point $p1)
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
    private function setP2(Point $p2)
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

    // setting and  getting
    private function setTilt(float $tilt)
    {
        try {
            $this->tilt = $tilt;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getTilt()
    {
        try {
            if (empty($this->generateTilt)) {
                $this->generateTilt();
            }
            return $this->tilt;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}