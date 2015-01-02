<?php

use PointReduction\Common\Point; //,
//    PointReduction\Algorithms\RamerDouglasPeucker as PRA;

class RamerDouglasPeuckerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers PointReduction\Algorithms\Protocol::apply
     * @covers PointReduction\Algorithms\RamerDouglasPeucker::apply
     */
    public function testApply()
    {
        $givenPoints = array(
        new Point(40,  40),
        new Point(54,  78),
        new Point(120, 112),
        new Point(175,  80),
        new Point(250,  55),
        new Point(275,  60),
        new Point(310,  90),
        new Point(435,  40)
        );
        $reducedPoints = PointReduction\Algorithms\RamerDouglasPeucker::apply($givenPoints, 25);
        $this->assertEquals($givenPoints[0], $reducedPoints[0]);
        $this->assertEquals($givenPoints[2], $reducedPoints[1]);
        $this->assertEquals($givenPoints[4], $reducedPoints[2]);
        $this->assertEquals($givenPoints[6], $reducedPoints[3]);
        $this->assertEquals($givenPoints[7], $reducedPoints[4]);
    }
}