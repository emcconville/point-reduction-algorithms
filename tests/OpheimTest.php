<?php
/**
 * This file is part of Point Reduction Algorithms library.
 * 
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage OpheimTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

use PointReduction\Common\Point,
    PointReduction\Algorithms\Opheim;

/**
 * PHPUnit test for Opheim algorithm
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage OpheimTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class OpheimTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Opheim algorithm
     *
     * @test
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     * @covers PointReduction\Algorithms\Opheim::reduce
     * @covers PointReduction\Algorithms\Opheim::_shortest
     * @covers PointReduction\Algorithms\Opheim::_distance
     * @covers PointReduction\Algorithms\Abstraction::shortestDistanceToSegment
     * @covers PointReduction\Algorithms\Abstraction::distanceBetweenPoints
     * @covers PointReduction\Algorithms\Abstraction::lastKey
     * @covers PointReduction\Algorithms\Abstraction::reindex
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
        $reducer = new Opheim($givenPoints);
        $reducedPoints = $reducer->reduce(150, 140);
        $this->assertEquals($givenPoints[0], $reducedPoints[0]);
        $this->assertEquals($givenPoints[2], $reducedPoints[1]);
        $this->assertEquals($givenPoints[3], $reducedPoints[2]);
        $this->assertEquals($givenPoints[6], $reducedPoints[3]);
        $this->assertEquals($givenPoints[7], $reducedPoints[4]);
    }
}