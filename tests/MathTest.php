<?php
/**
 * This file is part of Point Reduction Algorithms library.
 * 
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage MathTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

use PointReduction\Common\Math,
    PointReduction\Common\Line,
    PointReduction\Common\Point;

/**
 * PHPUnit test for Math object
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage MathTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class MathTest extends PHPUnit_Framework_TestCase
{
    /**
     * Smoke test area of triangle.
     *
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::areaOfTriangle
     *
     * @return NULL
     */
    public function testAreaOfTriangle()
    {
        $a = new Point(0, 0);
        $b = new Point(0, 9);
        $c = new Point(6, 0);
        $area = Math::areaOfTriangle($a, $b, $c);
        $this->assertEquals(27, $area);
    }

    /**
     * Smoke test the distance between to points.
     *
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::distanceBetweenPoints
     *
     * @return NULL
     */
    public function testDistanceBetweenPoints()
    {
        $a = new Point(1, 2);
        $b = new Point(3, 4);
        $actual = Math::distanceBetweenPoints($a, $b);
        $this->assertEquals(2.8284, $actual, null, 0.0001);
    }
    
    /**
     * Smoke test the pythagorus between to points.
     *
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::pythagoras
     *
     * @return NULL
     */
    public function testPythagoras()
    {
        $a = new Point(2, 4);
        $b = new Point(3, 6);
        $actual = Math::pythagoras($a, $b);
        $this->assertEquals(5.0, $actual);
    }

    /**
     * Smoke test the distance between point & line.
     *
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::shortestDistanceToSegment
     * @covers PointReduction\Common\Math::distanceBetweenPoints
     *
     * @return NULL
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
     * Smoke test the distance of a point on a line.
     *
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::shortestDistanceToSegment
     * @covers PointReduction\Common\Math::distanceBetweenPoints
     *
     * @return NULL
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
     * Smoke test the distance between a point & zero length line.
     *
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::shortestDistanceToSegment
     * @covers PointReduction\Common\Math::distanceBetweenPoints
     *
     * @return NULL
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