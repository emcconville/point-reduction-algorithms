<?php

namespace PointReduction\Common\Math;

function distanceBetweenPoints(Point $head, Point $tail)
{
  return pow($head->x - $tail->x, 2) + pow($head->y - $tail->y, 2);
}