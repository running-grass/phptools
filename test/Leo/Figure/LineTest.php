<?php
namespace Leo\Figure;

use Leo\Figure\Point;
use Leo\Figure\Line;

class LineTest extends \PHPUnit_Framework_TestCase
{
    private $data_e = [
        [[0,0], [0,0]],
        [[0,-0], [-0,0]],
        [[6,-6], [6,-6]],
    ];

    /**
     * @dataProvider addPointSet
     */
    public function testGetLength(array $arr, Line $l)
    {
        $this->assertEquals($arr[3],$l->getLength());
    }

    /**
     * @dataProvider addPointSet
     */
    public function testGetTilt(array $arr, Line $l)
    {
        $this->assertEquals($arr[2],$l->getTilt());
    }

    /**
     * @dataProvider addPointSet
     */
    public function testGetP1(array $arr, Line $l)
    {
        $p1 = new Point($arr[0][0],$arr[0][1]);
        $this->assertEquals($p1,$l->getP1());
    }

    /**
     * @dataProvider addPointSet
     */
    public function testGetP2(array $arr, Line $l)
    {
        $p2 = new Point($arr[1][0],$arr[1][1]);
        $this->assertEquals($p2,$l->getP2());
    }

    /**
     * @dataProvider addErrLine
     * @expectedException Leo\Figure\Exception\TwoPointOverlapException
     */
    public function testPoineOverlapExcep()
    {
        $v = func_get_args();
        $this->expectException(new Line(new Point($v[0][0], $v[0][1]), new Point($v[1][0], $v[1][1])));
        // $this->assertEquals($y,$p->getY());
    }

    public function addPointSet()
    {
        $data = [
            [[0,0], [0,1], 90, 1],
            [[0,0], [0,-1], 270, 1],
            [[0,0], [-1,0], 180, 1],
            [[0,0], [1,0], 0, 1],
            [[0,0], [1,1], 45, sqrt(2)],
            [[0,0], [-1,1], 135, sqrt(2)],
            [[0,0], [-1,-1], 225, sqrt(2)],
            [[0,0], [1,-1], 315, sqrt(2)],
            [[0,0], [1,sqrt(3)], 60, 2],
            [[0,0], [sqrt(3), 1], 30, 2],
        ];

        foreach ($data as $k => $v) {
            $arr[$k][0] = $v;
            $arr[$k][1] = new Line(new Point($v[0][0], $v[0][1]), new Point($v[1][0], $v[1][1]));
        }
        return $arr;
    }

    public function addErrLine()
    {
        return $this->data_e;
    }
}