<?php

namespace PointReduction\Common;

class Line
{
  public $head, $tail;
  public function __construct(Point $head, Point $tail)
  {
    $this->head = $head;
    $this->tail = $tail;
  }
}