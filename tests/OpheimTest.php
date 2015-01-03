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
     * @covers PointReduction\Algorithms\Protocol::apply
     * @covers PointReduction\Algorithms\Opheim::apply
     * @covers PointReduction\Common\Math::shortestDistanceToSegment
     * @covers PointReduction\Common\Math::distanceBetweenPoints
     * @covers PointReduction\Common\Math::lastKey
     *
     * @return NULL
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
        $reducedPoints = Opheim::apply($givenPoints, [75, 75]);
        $this->assertEquals($givenPoints[0], $reducedPoints[0]);
        $this->assertEquals($givenPoints[2], $reducedPoints[1]);
        $this->assertEquals($givenPoints[5], $reducedPoints[2]);
        $this->assertEquals($givenPoints[6], $reducedPoints[3]);
        $this->assertEquals($givenPoints[7], $reducedPoints[4]);
    }

    /**
     * Test method with bad param
     *
     * @test
     * @covers            PointReduction\Algorithms\Opheim::apply
     * @expectedException PointReduction\Algorithms\Exception
     *
     * @return NULL
     */
    public function testApplyBadParameter()
    {
        Opheim::apply(array(), 75);
    }
}