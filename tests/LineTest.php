<?php
/**
 * This file is part of Point Reduction Algorithms library.
 * 
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage LineTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

use PointReduction\Common\Point,
    PointReduction\Common\Line;

/**
 * PHPUnit test for Line object
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage LineTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class LineTest extends PHPUnit_Framework_TestCase
{
    /**
     * Just smoke test the constructor method
     *
     * @test
     * @smoke
     * @covers \PointReduction\Common\Line::__construct
     * @covers \PointReduction\Common\Point::__construct
     *
     * @return NULL
     */
    public function testConstruct()
    {
        $line = new Line(new Point(3, 6), new Point(4, 8));
        $this->assertEquals($line->head->x, 3);
        $this->assertEquals($line->head->y, 6);
        $this->assertEquals($line->tail->x, 4);
        $this->assertEquals($line->tail->y, 8);
    }
}