<?php

namespace PointReduction\Algorithms;
use PointReduction\Common\Math,
    PointReduction\Common\Line;

class Opheim implements Protocol
{
    static public function apply( $points, $tolerance )
    {
        if ( is_array($tolerance) ) {
            // Perpendicular tolerance
            $p = (double)array_pop($tolerance);
            // Radial tolerance
            $r = (double)array_pop($tolerance);
        } else {
            throw new Exception("Opheim requires a pair of tolerances.");
        }
        $key = 0;
        while ( $key < self::_lastPoint($points, -3) ) {
            $line = new Line($points[$key], $points[$key + 1]);
            $out = $key + 2;
            while ( $out < count($points)
                && Math::shortestDistanceToSegment($points[$out], $line) < $p
                && sqrt(Math::distanceBetweenPoints($points[$key], $points[$out])) < $r
            ) {
                $out++;
            }
            array_splice($points,$key+1,$out-1);
            $key++;
        }
        return $points;
    }

    static private function _lastPoint( $points, $index = -1 )
    {
        return key(array_slice($points, $index, 1, true));
    }
}