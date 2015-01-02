<?php

use PointReduction\Common\Point,
    PointReduction\Common\Line;

class LineTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @smoke
     * @covers \PointReduction\Common\Line::__construct
     * @covers \PointReduction\Common\Point::__construct
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