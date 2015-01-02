<?php

use PointReduction\Common\Point;

class OpheimTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers PointReduction\Algorithms\Protocol::apply
     * @covers PointReduction\Algorithms\Opheim::apply
     * @covers PointReduction\Algorithms\Opheim::_lastPoint
     * @covers PointReduction\Common\Math::shortestDistanceToSegment
     * @covers PointReduction\Common\Math::distanceBetweenPoints
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
        $reducedPoints = PointReduction\Algorithms\Opheim::apply($givenPoints, [75, 75]);
        $this->assertEquals($givenPoints[0], $reducedPoints[0]);
        $this->assertEquals($givenPoints[2], $reducedPoints[1]);
        $this->assertEquals($givenPoints[4], $reducedPoints[2]);
        $this->assertEquals($givenPoints[7], $reducedPoints[3]);
    }
    /**
     * @test
     * @covers PointReduction\Algorithms\Opheim::apply
     * @expectedException PointReduction\Algorithms\Exception
     */
    public function testApplyBadParameter()
    {
        PointReduction\Algorithms\Opheim::apply(array(), 75);
    }
}