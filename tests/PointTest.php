<?php
/**
 * This file is part of Point Reduction Algorithms library.
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage PointTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

use PointReduction\Common\Point,
    PointReduction\Common\Line;

/**
 * PHPUnit test for Point object
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage PointTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class PointTest extends PHPUnit_Framework_TestCase
{
    /**
     * Smoke test point object
     *
     * @test
     * @smoke
     * @covers \PointReduction\Common\Point::__construct
     *
     * @return null
     */
    public function testConstruct()
    {
        $point = new Point(3.4, 6.8);
        $this->assertEquals($point->x, 3.4);
        $this->assertEquals($point->y, 6.8);
    }

    /**
     * Smoke test point object interface
     *
     * @test
     * @smoke
     * @covers \PointReduction\Common\Point::__construct
     * @covers \PointReduction\Common\Point::getCoordinates
     * @covers \PointReduction\Common\PointInterface::getCoordinates
     *
     * @return null
     */
     public function testGetCoordinates()
     {
         $point = new Point(3.4, 6.8);
         $actual = $point->getCoordinates();
         $this->assertEquals(array(3.4, 6.8), $actual);
     }

    /**
     * Smoke test point object interface
     *
     * @test
     * @smoke
     * @covers \PointReduction\Common\Point::__construct
     * @covers \PointReduction\Common\Point::__toString
     *
     * @return null
     */
     public function testToString()
     {
         $point = new Point(3.4, 6.8);
         $string = $point->__toString();
         $this->assertEquals('3.4,6.8', $string);

         $string = (string) $point;
         $this->assertEquals('3.4,6.8', $string);

         $points = [
            new Point(1, 2),
            new Point(3, 4),
         ];
         $string = implode(' ', $points);
         $this->assertEquals('1,2 3,4', $string);
     }
}
