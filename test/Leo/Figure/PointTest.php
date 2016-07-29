<?php
namespace Leo\Figure;

use Leo\Figure\Point;

class PointTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider addPointSet
     */
    public function testGetX($x, $y)
    {
        $p = new Point($x,$y);
        $this->assertEquals($x,$p->getX());
    }

    /**
     * @dataProvider addPointSet
     */
    public function testGetY($x, $y)
    {
        $p = new Point($x,$y);
        $this->assertEquals($y,$p->getY());
    }

    public function addPointSet()
    {
        return [
            [0,0],
            [0,4],
            [0,7],
            [0,10],
            [0,-5.0],
            [0,-12.6],
            [0,-90.34],
            [0.3,-12.6],
            [10.5,-12.1],
            [100,-12.3],
            [100,-12.0],
            [-100,-12.9],
            [-10,12],
            [-23.56, 0.556]
        ];
    }
}