<?php

use PointReduction\Common\Math,
    PointReduction\Common\Point;


class MathTest extends PHPUnit_Framework_TestCase
{
    /**
   * @test
   * @smoke
   * @covers PointReduction\Common\Math::distanceBetweenPoints
   */
    public function testDistanceBetweenPoints()
    {
        $actual = Math::distanceBetweenPoints(new Point(2, 4), new Point(3, 6));
        $this->assertEquals(5.0, $actual);
    }

    /**
   * @test
   * @smoke
   * @covers PointReduction\Common\Math::shortestDistanceToSegment
   * @covers PointReduction\Common\Math::distanceBetweenPoints
   */
    public function testShortestDistanceToSegment()
    {
        $actual = Math::shortestDistanceToSegment(
            new Point(4, 3),
            new Point(2, 4),
            new Point(4, 4)
        );
        $this->assertEquals(1.0, $actual);
    }
}