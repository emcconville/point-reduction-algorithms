<?php

namespace PointReduction\Algorithms;
use PointReduction\Common\Math,
    PointReduction\Common\Line;

class ReumannWitkam implements Protocol
{
    static public function apply( $points, $tolerance )
    {
        $key = 0;
        while ( $key < self::_lastPoint($points, -3) ) {
            $line = new Line($points[$key], $points[$key + 1]);
            $out = $key + 2;
            printf("_Distances %0.2f\n", Math::shortestDistanceToSegment($points[$out], $line));
            while ( $out < self::_lastPoint($points)
                && Math::shortestDistanceToSegment($points[$out], $line) < $tolerance
            ) {
                printf("Distances %0.2f\n", Math::shortestDistanceToSegment($points[$out], $line));
                $out++;
            }
            printf("Key : $key, Out : $out\n");
            array_splice($points, $key + 1, $out - 1);
            $key++;
        }
        return $points;
    }
    static private function _lastPoint( $points, $index = -1 )
    {
        return key(array_slice($points, $index, 1, true));
    }
}