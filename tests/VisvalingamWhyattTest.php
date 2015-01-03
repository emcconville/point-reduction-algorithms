<?php
/**
 * This file is part of Point Reduction Algorithms library.
 * 
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage VisvalingamWhyatt
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

use PointReduction\Common\Point;

/**
 * PHPUnit test for Visvalingam-Whyatt algorithm
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage VisvalingamWhyattTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class VisvalingamWhyatt extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers PointReduction\Algorithms\Protocol::apply
     * @covers PointReduction\Algorithms\VisvalingamWhyatt::apply
     * @covers PointReduction\Common\Math::areaOfTriangle
     * @covers PointReduction\Common\Math::lastKey
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
        $reducedPoints = PointReduction\Algorithms\VisvalingamWhyatt::apply($givenPoints, 5);
        $this->assertEquals($givenPoints[0], $reducedPoints[0]);
        $this->assertEquals($givenPoints[2], $reducedPoints[1]);
        $this->assertEquals($givenPoints[4], $reducedPoints[2]);
        $this->assertEquals($givenPoints[6], $reducedPoints[3]);
        $this->assertEquals($givenPoints[7], $reducedPoints[4]);
    }
}