<?php
namespace Leo\Figure;

use \Leo\Figure\Point;
use \Leo\Figure\Line;
use \Leo\Figure\Polygon;
use \Leo\Figure\ConvexPolygon;

// 矩形类
class Rect extends ConvexPolygon
{
    private $p1;
    private $p2;
    private $p1_1;
    private $p2_1;

    public function __construct(Point $p1, Point $p2)
    {
        try {
            // 反转x坐标
            if ($p1->getX() > $p2->getX()) {
                $x = $p1->getX();
                $p1->setX($p2->getX());
                $p2->setX($x);
            }
            // 反转y坐标
            if ($p1->getY() > $p2->getY()) {
                $y = $p1->getY();
                $p1->setY($p2->getY());
                $p2->setY($y);
            }
            $this->setP1($p1);
            $this->setP2($p2);
            $this->setP1_1(new Point($p2->getX(),$p1->getY()));
            $this->setP2_1(new Point($p1->getX(),$p2->getY()));

            $arr = [
                $this->getP1(),
                $this->getP1_1(),
                $this->getP2(),
                $this->getP2_1()
            ];
            parent::__construct($arr);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 判断一个点是否在矩形内
    public function inRect(Point $p)
    {
        try {
            $p1 = $this->getP1();
            $p2 = $this->getP2();

            $is = false;
            if ($p->getX() <= $p2->getX()
                && $p->getX() >= $p1->getX()
                && $p->getY() <= $p2->getY()
                && $p->getY() >= $p1->getY()) {
                // dump($p);
                $is = true;
            } else {
                $is = false;
            }

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
    private function setP1_1(Point $p1)
    {
        try {
            $this->p1_1 = $p1;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getP1_1()
    {
        try {
            return $this->p1_1;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    private function setP2_1(Point $p2)
    {
        try {
            $this->p2_1 = $p2;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getP2_1()
    {
        try {
            return $this->p2_1;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}