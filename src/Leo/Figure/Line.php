<?php
namespace Leo\Figure;

use \Leo\Base;
use \Leo\Figure\Point;

// 异常
use \Leo\Figure\Exception\LineOverlapException;
use \Leo\Figure\Exception\TwoPointOverlapException;

// 线段类
class Line extends Base
{
    private $p1;     // 线段第一个点
    private $p2;     // 线段的第二个点
    private $tilt;   // 倾斜角，距x轴正方向的逆时针角度
    private $length; // 线段的长度

    public function __construct(Point $p1, Point $p2)
    {
        try {
            // 两个端点不能重合，没长度
            if ($p1 == $p2) {
                throw new TwoPointOverlapException('两个端点不能重合');
            }
            $this->setP1($p1);
            $this->setP2($p2);
            unset($p1, $p2);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 生成线段的长度
    private function generateLength()
    {
        try {
            // 利用勾股定理
            $length = sqrt(pow($this->getP1()->getX() - $this->getP2()->getX(), 2) +
                           pow($this->getP1()->getY() - $this->getP2()->getY(), 2));
            $this->setLength(abs($length));
            unset($length);
            return 0;
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

            // 不同的象限不同处理，dx为零的情况单独处理
            if ($dx > 0 && $dy >= 0) {
                $ang = (rad2deg(atan($dy/$dx)));
                $ext = 0;
            } elseif ($dx <= 0 && $dy >= 0) {
                if (0 == $dx) {
                    $ang = 0;
                    $ext = 90;
                } else {
                    $ang = (rad2deg(atan($dy/$dx)));
                    $ext = 180;
                }
            } elseif ($dx < 0 && $dy <= 0) {
                $ang = (rad2deg(atan($dy/$dx)));
                $ext = 180;
            } elseif ($dx >= 0 && $dy < 0) {
                if (0 == $dx) {
                    $ang = 0;
                    $ext = 270;
                } else {
                    $ang = (rad2deg(atan($dy/$dx)));
                    $ext = 360;
                }
            }
            $ang = $ang + $ext;
            $this->setTilt($ang);

            unset($dx, $dy, $ang, $ext);
            return 0;
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
            $is = false;
            // 这个点和这条线段的两个端点生成的两条线的倾斜角要互补
            if (180 == abs($l1->getTilt() - $l2->getTilt())) {
                $is = true;
            } else {
                $is = false;
            }

            unset($l1, $l2);
            return $is;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    private function setP1(Point $p1)
    {
        try {
            $this->p1 = $p1;
            unset($p1);
            return 0;
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
            unset($p2);
            return 0;
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
    private function setTilt($tilt)
    {
        try {
            $this->tilt = (float)$tilt;
            unset($tilt);
            return 0;
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

    // setting and  getting
    private function setLength($length)
    {
        try {
            $this->length = (float)$length;
            unset($length);
            return 0;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getLength()
    {
        try {
            if (empty($this->length)) {
                $this->generateLength();
            }
            return $this->length;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function __toString()
    {
        try {
            return '[' . (string)$this->getP1() . '->' . (string)$this->getP2() . ']';
        } catch (\Exception $e) {
            throw $e;
        }
    }
}