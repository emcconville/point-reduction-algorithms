<?php
/**
 * This file is part of Point Reduction Algorithms library.
 * 
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage AbstractionTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

use PointReduction\Common\Point,
    PointReduction\Algorithms\Abstraction;

/**
 * Mock test class for testing methods on base abstraction.
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage MockAlgorithm
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class MockAlgorithm extends Abstraction
{
    /**
     * Access protected points in test case.
     * @return array
     */
    public function getPoints()
    {
        return $this->points;
    }
};

/**
 * PHPUnit test for base abstraction point assignment.
 *
 * @category   PointReduction
 * @package    Test
 * @subpackage AbstractionTest
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class AbstractionTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test point assignment with list of coordinate array.
     *
     * @test
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     *
     * @return NULL
     */
    public function testSetPointsWithCoordinateArray()
    {
        $userPoints = [
            [1, 2],
            [3, 4],
            [5, 6]
        ];
        $instance = new MockAlgorithm($userPoints);
        $instance->setPoints($userPoints);
        foreach ($instance->getPoints() as $index => $point) {
            $actual = $point->getCoordinates();
            $expected = $userPoints[$index];
            $this->assertEquals($actual, $expected);
        }
    }

    /**
     * Test point assignment with list of associative array.
     *
     * @test
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     *
     * @return NULL
     */
    public function testSetPointsWithAssociativeCoordinateArray()
    {
        $userPoints = [
            ['x' => 1, 'y' => 2],
            ['lat' => 3, 'lng' => 4],
            ['left' => 5, 'top' => 6]
        ];
        $instance = new MockAlgorithm($userPoints);
        $instance->setPoints($userPoints);
        foreach ($instance->getPoints() as $index => $point) {
            $actual = $point->getCoordinates();
            $expected = array_values($userPoints[$index]);
            $this->assertEquals($actual, $expected);
        }
    }

    /**
     * Test point assignment with list of Point objects.
     *
     * @test
     * @covers PointReduction\Algorithms\Abstraction::setPoints
     *
     * @return NULL
     */
    public function testSetPointsWithInterfaceArray()
    {
        $userPoints = [
            new Point(1, 2),
            new Point(3, 4),
            new Point(5, 6)
        ];
        $instance = new MockAlgorithm();
        $instance->setPoints($userPoints);
        foreach ($instance->getPoints() as $index => $point) {
            $actual = $point->getCoordinates();
            $expected = $userPoints[$index]->getCoordinates();
            $this->assertEquals($actual, $expected);
        }
    }
}
