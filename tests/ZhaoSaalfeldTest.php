<?php
/**
 * This file is part of Point Reduction Algorithms library.
 * 
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage ZhaoSaalfeldTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

use PointReduction\Common\Point,
    PointReduction\Algorithms\ZhaoSaalfeld;

/**
 * PHPUnit test for Zhao-Saalfeld simplification algorithm
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage ZhaoSaalfeldTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class ZhaoSaalfeldTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Zhao-Saalfeld simplification algorithm
     *
     * @test
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     * @covers PointReduction\Algorithms\ZhaoSaalfeld::reduce
     * @covers PointReduction\Algorithms\ZhaoSaalfeld::theta
     * @covers PointReduction\Algorithms\Abstraction::lastKey
     * @covers PointReduction\Algorithms\Abstraction::count
     *
     * @return NULL
     */
    public function testReduce()
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
        $reducer = new ZhaoSaalfeld($givenPoints);
        $reducedPoints = $reducer->reduce(15, 3);
        $this->assertEquals($givenPoints[0], $reducedPoints[0]);
        $this->assertEquals($givenPoints[1], $reducedPoints[1]);
        $this->assertEquals($givenPoints[2], $reducedPoints[2]);
        $this->assertEquals($givenPoints[5], $reducedPoints[3]);
        $this->assertEquals($givenPoints[6], $reducedPoints[4]);
    }

    /**
     * Ensure through zero handling.
     *
     * @test
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     * @covers PointReduction\Algorithms\ZhaoSaalfeld::reduce
     * @covers PointReduction\Algorithms\ZhaoSaalfeld::theta
     * @covers PointReduction\Algorithms\Abstraction::lastKey
     * @covers PointReduction\Algorithms\Abstraction::count
     *
     * @return NULL
     */
    public function testReduceAroundZero()
    {
        $givenPoints = array(
            new Point(3, 3), // Start corner
            new Point(3, 2),
            new Point(3, 1),
            new Point(3, 0),
            new Point(3, -1),
            new Point(3, -2),
            new Point(3, -3), // Key corner
            new Point(2, -3),
            new Point(1, -3),
            new Point(0, -3),
            new Point(-1, -3),
            new Point(-2, -3),
            new Point(-3, -3), // Key corner
            new Point(-3, -2),
            new Point(-3, -1),
            new Point(-3, 0),
            new Point(-3, 1),
            new Point(-3, 2),
            new Point(-3, 3), // Key corner
            new Point(-2, 3),
            new Point(-1, 3),
            new Point(0, 3),
            new Point(1, 3),
            new Point(2, 3),
            new Point(3, 3) // Same as first
        );
        $reducer = new ZhaoSaalfeld($givenPoints);
        $reducedPoints = $reducer->reduce(10, 6);
        $this->assertContains($givenPoints[0], $reducedPoints);
        $this->assertContains($givenPoints[6], $reducedPoints);
        $this->assertContains($givenPoints[12], $reducedPoints);
        $this->assertContains($givenPoints[18], $reducedPoints);
    }
}