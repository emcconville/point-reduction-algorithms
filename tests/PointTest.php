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
     * @return NULL
     */
    public function testConstruct()
    {
        $point = new Point(3.4, 6.8);
        $this->assertEquals($point->x, 3.4);
        $this->assertEquals($point->y, 6.8);
    }
}