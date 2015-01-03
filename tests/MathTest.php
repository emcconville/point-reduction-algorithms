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
     * @test
     * @smoke
     * @covers PointReduction\Common\Math::areaOfTriangle
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