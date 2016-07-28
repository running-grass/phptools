<?php
namespace Leo\Figure;

use \Leo\Figure\Point;
use \Leo\Figure\Line;
use \Leo\Figure\Angle;
use \Leo\Figure\Triangle;
use \Leo\Figure\Polygon;

// 凸多边形类
class ConvexPolygon extends Polygon
{
    private $triangles;

    public function __construct(array $arr_point)
    {
        try {
            parent::__construct($arr_point);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 判断是否在凸多边形内
    public function inConvexPolygon(Point $p)
    {
        try {
            $arr_tri = $this->getTriangles();
            $is = false;
            foreach ($arr_tri as $tri) {
                if ($tri->inTriangle($p)) {
                    $is = true;
                    break;
                }
            }
            return $is;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 生成三角形集合
    private function generateTriangles()
    {
        try {
            $num = $this->getNumber();
            $ps = $this->getPoints();
            $p0 = $ps[0];
            unset($ps[0]);
            for ($i = 1; $i < $num - 1; $i++) {
                $arr[] = new Triangle($p0, $ps[$i], $ps[$i+1]);
            }
            $this->setTriangles($arr);
            unset($num);
            unset($ps);
            unset($p0);
            unset($arr);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // setting and  getting
    private function setTriangles($arr)
    {
        try {
            $this->triangles= $arr;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function getTriangles()
    {
        try {
            if ('Leo\Figure\Triangle' != get_class($this)) {
                if (empty($this->triangles)) {
                    $this->generateTriangles();
                }
            }
            return $this->triangles;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}