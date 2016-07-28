<?php
namespace Leo\Figure;

use \Leo\Base;
use \Leo\Figure\Point;
use \Leo\Figure\Line;
use \Leo\Figure\Angle;
use \Leo\Figure\Triangle;
use \Leo\Figure\ConvexPolygon;

// 异常
use \Leo\Figure\Exception\LineOverlapException;
use \Leo\Figure\Exception\TwoPointOverlapException;

// 多边形类
class Polygon extends Base
{
    private $points;
    private $lines;
    private $angles;
    private $number;

    public function __construct(array $arr_point)
    {
        try {
            $this->setPoints($arr_point);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function inPolygon(Point $p)
    {
        try {
            // dump($this);
            // 首先判断是否在几何图形的边框上
            $is = false;
            foreach ($this->getLines() as $l) {
                try {
                    $on_line = $l->inLine($p);
                    if ($on_line) {
                        $is = true;
                        break;
                    }
                } catch (TwoPointOverlapException $e) {
                    $is = true;
                    break;
                }
            }
            // 如果点在边上，直接返回
            if ($is) return $is;


            $as = $this->getAngles();
            $ls = $this->getLines();

            // foreach ($ls as $a) {
            //     dump("{$a->getP1()->getX()},{$a->getP1()->getY()}");
            //     dump("{$a->getP2()->getX()},{$a->getP2()->getY()}");
            //     dump($a->getTilt());
            // }
            // die;


            $arr_tri_concave = [];

            $convex;
            $new_pol;

            $as1 = $as;
            $ls1 = $ls;

            // 把凹多边形变为凸多边形，并且形成一个缺失三角形集合
            while(1) {
                $c_ls = count($ls1);
                $ls1[] = $ls1[0];
                $ls1[-1] = $ls1[$c_ls -1];
                if (false !== $i = $this->checkConcave($as1)) {
                    $arr_tri_concave[] = new Triangle($ls1[$i-1]->getP1(),
                                                      $ls1[$i+1]->getP1(),
                                                      $ls1[$i]->getP1());

                    unset($ls1[$i]);
                    unset($ls1[$c_ls]);
                    unset($ls1[-1]);
                    $arr_point = [];
                    foreach ($ls1 as $v) {
                        $arr_point[] = $v->getP1();
                    }

                    $new_pol = new Polygon($arr_point);
                    $as1 = $new_pol->getAngles();
                    $ls1 = $new_pol->getLines();
                } else {
                    unset($ls1[-1]);
                    unset($ls1[$c_ls]);
                    $arr_point = [];
                    foreach ($ls1 as $v) {
                        $arr_point[] = $v->getP1();
                    }
                    $convex = new ConvexPolygon($arr_point);
                    break;
                }
            }

            unset($as1);
            unset($ls1);
            unset($as);
            unset($ls);

            // dump($convex->getTriangles());

            $is = true;
            if ($convex->inConvexPolygon($p)) {
                foreach ($arr_tri_concave as $v) {
                    if ($v->inTriangle($p)) {
                        $is = false;
                        break;
                    }
                }
            } else {
                $is = false;
            }
            return $is;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 检测是否有凹点，如果有返回该凹点
    private function checkConcave($angles)
    {
        try {
            for ($i = 0; $i < count($angles); $i++) {
                if (180 < $angles[$i]->getAngle()) {
                    return $i;
                }

            }

            return false;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 生成所以边线
    private function generateLines()
    {
        try {
            $ps = $this->getPoints();
            $count = count($ps);

            $arr = [];
            $ps[] = $ps[0];
            for ($k = 0; $k < $count; $k++) {
                $arr[] = new Line($ps[$k], $ps[$k+1]);
            }
            $this->setLines($arr);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 生成所以边线
    private function generateAngles()
    {
        try {
            $ls = $this->getLines();
            $c = count($ls);
            $ls[-1] = $ls[$c -1];
            for ($k = -1; $k < count($ls)-2; $k++) {
                $arr[] = new Angle($ls[$k], $ls[$k+1]);
            }
            $this->setAngles($arr);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 边数
    private function setNumber(int $num)
    {
        try {
            $this->number = $num;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getNumber()
    {
        try {
            if (empty($this->number)) {
                $arr = $this->getPoints();
                $this->setNumber(count($arr));
                unset($arr);
            }
            return $this->number;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 点集
    private function setPoints($arr_point)
    {
        try {
            $this->points = $arr_point;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getPoints()
    {
        try {
            return $this->points;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 线段集
    private function setLines($arr_line)
    {
        try {
            $this->lines = $arr_line;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getLines()
    {
        try {
            if (empty($this->lines)) {
                $this->generateLines();
            }
            return $this->lines;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 内角集
    private function setAngles($arr_angle)
    {
        try {
            $this->angles = $arr_angle;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getAngles()
    {
        try {
            if (empty($this->angles)) {
                $this->generateAngles();
            }
            return $this->angles;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}