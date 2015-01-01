<?php

use PointReduction\Common\Point,
    PointReduction\Common\Line;

class PointTest extends PHPUnit_Framework_TestCase
{
  /**
   * @test
   * @smoke
   * @covers \PointReduction\Common\Point::__construct
   */
  public function testConstruct()
  {
    $point = new Point(3.4, 6.8);
    $this->assertEquals($point->x, 3.4);
    $this->assertEquals($point->y, 6.8);
  }
}