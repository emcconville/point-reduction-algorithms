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

use PointReduction\Algorithms\Abstraction,
    PointReduction\Common\Point;

/**
 * Mock abstraction class
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage MathTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class MockMath extends Abstraction
{
}

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
     * Smoke test error handling
     *
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     * @expectedException PointReduction\Algorithms\InvalidArgumentException
     *
     * @return null
     */
    public function testBadArgument()
    {
        $obj = new MockMath;
        $obj->setPoints(false);
    }

    /**
     * Smoke test error handling
     *
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     * @expectedException PointReduction\Algorithms\InvalidArgumentException
     *
     * @return null
     */
    public function testBadPointArgument()
    {
        $obj = new MockMath;
        $obj->setPoints(array(new Point(0,1), false));
    }

    /**
     * Smoke test area of triangle.
     *
     * @test
     * @smoke
     * @covers PointReduction\Algorithms\Abstraction::areaOfTriangle
     *
     * @return NULL
     */
    public function testAreaOfTriangle()
    {
        $a = new Point(0, 0);
        $b = new Point(0, 9);
        $c = new Point(6, 0);

        $method = new ReflectionMethod('MockMath', 'areaOfTriangle');
        $method->setAccessible(true);
        $actual = $method->invokeArgs(new MockMath, array($a, $b, $c));

        $this->assertEquals(27, $actual);
    }

    /**
     * Smoke test the distance between to points.
     *
     * @test
     * @smoke
     * @covers PointReduction\Algorithms\Abstraction::distanceBetweenPoints
     *
     * @return NULL
     */
    public function testDistanceBetweenPoints()
    {
        $a = new Point(1, 2);
        $b = new Point(3, 4);

        $method = new ReflectionMethod('MockMath', 'distanceBetweenPoints');
        $method->setAccessible(true);
        $actual = $method->invokeArgs(new MockMath, array($a, $b));

        $this->assertEquals(2.8284, $actual, null, 0.0001);
    }
    
    /**
     * Smoke test the pythagorus between to points.
     *
     * @test
     * @smoke
     * @covers PointReduction\Algorithms\Abstraction::pythagorus
     *
     * @return NULL
     */
    public function testPythagorus()
    {
        $a = new Point(2, 4);
        $b = new Point(3, 6);

        $method = new ReflectionMethod('MockMath', 'pythagorus');
        $method->setAccessible(true);
        $actual = $method->invokeArgs(new MockMath, array($a, $b));

        $this->assertEquals(5.0, $actual);
    }

    /**
     * Smoke test the distance between point & line.
     *
     * @test
     * @smoke
     * @covers PointReduction\Algorithms\Abstraction::shortestDistanceToSegment
     * @covers PointReduction\Algorithms\Abstraction::distanceBetweenPoints
     *
     * @return NULL
     */
    public function testShortestDistanceToSegment()
    {
        $a = new Point(4, 3);
        $b = new Point(2, 4);
        $c = new Point(4, 4);
        $method = new ReflectionMethod('MockMath', 'shortestDistanceToSegment');
        $method->setAccessible(true);
        $actual = $method->invokeArgs(new MockMath, array($a, $b, $c));

        $this->assertEquals(1.0, $actual);
    }

    /**
     * Smoke test the distance of a point on a line.
     *
     * @test
     * @smoke
     * @covers PointReduction\Algorithms\Abstraction::shortestDistanceToSegment
     * @covers PointReduction\Algorithms\Abstraction::distanceBetweenPoints
     *
     * @return NULL
     */
    public function testShortestDistanceToSegmentPointAtEnd()
    {
        $a = new Point(4, 4);
        $b = new Point(3, 3);
        $c = new Point(4, 4);
        $method = new ReflectionMethod('MockMath', 'shortestDistanceToSegment');
        $method->setAccessible(true);
        $actual = $method->invokeArgs(new MockMath, array($a, $b, $c));

        $this->assertEquals(0.0, $actual);
    }

    /**
     * Smoke test the distance of a point on a line.
     *
     * @test
     * @smoke
     * @covers PointReduction\Algorithms\Abstraction::shortestDistanceToSegment
     * @covers PointReduction\Algorithms\Abstraction::distanceBetweenPoints
     *
     * @return NULL
     */
    public function testShortestDistanceToSegmentPointAtBegin()
    {
        $a = new Point(5, 4);
        $b = new Point(4, 4);
        $c = new Point(3, 3);
        $method = new ReflectionMethod('MockMath', 'shortestDistanceToSegment');
        $method->setAccessible(true);
        $actual = $method->invokeArgs(new MockMath, array($a, $b, $c));

        $this->assertEquals(1.0, $actual);
    }

    /**
     * Smoke test the distance between a point & zero length line.
     *
     * @test
     * @smoke
     * @covers PointReduction\Algorithms\Abstraction::shortestDistanceToSegment
     * @covers PointReduction\Algorithms\Abstraction::distanceBetweenPoints
     *
     * @return NULL
     */
    public function testShortestDistanceToEmptyLine()
    {
        $a = new Point(3, 4);
        $b = new Point(4, 4);
        $c = new Point(4, 4);
        $method = new ReflectionMethod('MockMath', 'shortestDistanceToSegment');
        $method->setAccessible(true);
        $actual = $method->invokeArgs(new MockMath, array($a, $b, $c));
        $this->assertEquals(1.0, $actual);
    }
}