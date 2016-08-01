<?php
namespace Leo;

use Leo\Arr;

class ArrTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider array_empty
     */
    public function testFilterEmpty($arr,$arr1)
    {
        $arr2 = $arr;
        $arr3 = Arr::filter_empty($arr);
        $this->assertEquals($arr1,$arr);
        $this->assertEquals(0,$arr3);
    }

    public function array_empty()
    {
        return [
            [
                [
                    23,3443,''
                ],[
                    23,3443
                ]
            ]
        ];
    }
}