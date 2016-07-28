<?php
namespace Leo\Figure;

use \Leo\Figure\Point;
use \Leo\Figure\Line;
use \Leo\Figure\Polygon;
use \Leo\Figure\ConvexPolygon;

// 异常
use \Leo\Figure\Exception\LineOverlapException;

// 矩形类
class Triangle extends ConvexPolygon
{
    protected $p1;
    protected $p2;
    protected $p3;

    public function __construct(Point $p1, Point $p2, Point $p3)
    {
        try {
            $this->setP1($p1);
            $this->setP2($p2);
            $this->setP3($p3);

            $arr = [
                $this->getP1(),
                $this->getP2(),
                $this->getP3()
            ];
            parent::__construct($arr);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 判断一个点是否在矩形内
    public function inTriangle(Point $p)
    {
        try {
            $p1 = $this->getP1();
            $p2 = $this->getP2();
            $p3 = $this->getP3();

            $ls = $this->getLines();

            $l1 = new Line($p, $p1);
            $l2 = new Line($p, $p2);
            $l3 = new Line($p, $p3);

            $a1 = (new Angle($l1, $ls[0]))->getAngle();
            $a2 = (new Angle($l2, $ls[1]))->getAngle();
            $a3 = (new Angle($l3, $ls[2]))->getAngle();

            // $t = new Angle($l3, $ls[2]);
            // dump($t);
            // dump($t->getAngle());

            $l1 = new Line($p1, $p);
            $l2 = new Line($p2, $p);
            $l3 = new Line($p3, $p);

            $b1 = (new Angle($ls[2], $l1))->getAngle();
            $b2 = (new Angle($ls[0], $l2))->getAngle();
            $b3 = (new Angle($ls[1], $l3))->getAngle();


            // $as  = $tri->getAngles();
            // foreach ($as as $a) {
            //     dump($a->getAngle());
            // }

            // dump($this);
            // dump("$a1/ $a2/ $a3/ $b1/ $b2/ $b3");
            // die;

            $c = $a1 + $a2 + $a3 + $b1 + $b2 + $b3;


            $is = false;
            if (180 >= (int)$c) {
                $is = true;
            } else {
                $is = false;
            }
            return $is;
        } catch (LineOverlapException $e) {
            return true;
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
    private function setP3(Point $p3)
    {
        try {
            $this->p3 = $p3;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getP3()
    {
        try {
            return $this->p3;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}