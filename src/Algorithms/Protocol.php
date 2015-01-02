<?php

namespace PointReduction\Algorithms;

interface Protocol
{
    static public function apply( $points, $tolerance );
}