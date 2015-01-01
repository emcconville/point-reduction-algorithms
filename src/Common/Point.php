<?php

namespace PointReduction\Common;

class Point
{
  public $x, $y;
  public function __construct($x,$y)
  {
    $this->x = $x;
    $this->y = $y;
  }
}