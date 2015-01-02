<?php

use PointReduction\Common\Math,
    PointReduction\Common\Line,
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
            new Line(new Point(2, 4), new Point(4, 4))
        );
        $this->assertEquals(1.0, $actual);
    }

    /**
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::shortestDistanceToSegment
     * @covers PointReduction\Common\Math::distanceBetweenPoints
     */
    public function testShortestDistanceToSegmentPointAtEnd()
    {
        $actual = Math::shortestDistanceToSegment(
            new Point(4, 4),
            new Line(new Point(3, 3), new Point(4, 4))
        );
        $this->assertEquals(0.0, $actual);
    }

    /**
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::shortestDistanceToSegment
     * @covers PointReduction\Common\Math::distanceBetweenPoints
     */
    public function testShortestDistanceToEmptyLine()
    {
        $actual = Math::shortestDistanceToSegment(
            new Point(3, 4),
            new Line(new Point(4, 4), new Point(4, 4))
        );
        $this->assertEquals(1.0, $actual);
    }
}