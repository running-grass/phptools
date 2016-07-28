<?php
namespace Leo\Figure;

use \Leo\Base;
use \Leo\Figure\Point;
use \Leo\Figure\Line;

// 异常
use \Leo\Figure\Exception\LineOverlapException;

// 角度类
class Angle extends Base
{
    private $l1;
    private $l2;
    private $angle;

    public function __construct(Line $l1, Line $l2)
    {
        try {
            if ($l1->getP2() != $l2->getP1()) {
                throw new \Exception('两条线段不是首尾相连');
            }
            // 会引起错误
            // if (360 == ($l1->getTilt() + $l2->getTilt())) {
                // throw new LineOverlapException('两条线段不能重叠');
            // }
            $this->setL1($l1);
            $this->setL2($l2);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function generateAngle()
    {
        try {
            $angle =  $this->getL1()->getTilt() - $this->getL2()->getTilt() + 180;
            $angle = fmod(($angle + 360),360);
            $this->setAngle($angle);
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
    public function setL2(Line $l2)
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

    // setting and  getting
    private function setAngle($angle)
    {
        try {
            $this->angle = $angle;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getAngle()
    {
        try {
            if (empty($this->angle)) {
                $this->generateAngle();
            }
            return $this->angle;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function __toString()
    {
        try {
            return '{' . (string)$this->getL1() . '=>' . (string)$this->getL2() . '}';
        } catch (\Exception $e) {
            throw $e;
        }
    }

}