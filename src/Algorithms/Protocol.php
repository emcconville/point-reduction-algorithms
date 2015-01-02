<?php

namespace PointReduction\Algorithms;

/**
 * @codeCoverageIgnore
 */
interface Protocol
{
    static public function apply( $points, $tolerance );
}