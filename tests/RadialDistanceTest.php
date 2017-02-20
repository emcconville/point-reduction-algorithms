<?php
/**
 * This file is part of Point Reduction Algorithms library.
 * 
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage RadialDistanceTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

use PointReduction\Common\Point,
    PointReduction\Algorithms\RadialDistance;

/**
 * PHPUnit test for Radial Distance algorithm.
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage RadialDistanceTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class RadialDistanceTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Radial Distance algorithm
     *
     * @test
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     * @covers PointReduction\Algorithms\RadialDistance::reduce
     * @covers PointReduction\Algorithms\RadialDistance::_isInTolerance
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
        $reducer = new RadialDistance($givenPoints);
        $reducedPoints = $reducer->reduce(75);
        $this->assertEquals($givenPoints[0], $reducedPoints[0]);
        $this->assertEquals($givenPoints[2], $reducedPoints[1]);
        $this->assertEquals($givenPoints[4], $reducedPoints[2]);
        $this->assertEquals($givenPoints[7], $reducedPoints[3]);

    }
}