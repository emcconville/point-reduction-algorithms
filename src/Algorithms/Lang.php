<?php

namespace PointReduction\Algorithms;
use PointReduction\Common\Math,
    PointReduction\Common\Line;

class Lang implements Protocol
{
    static public function apply( $points, $tolerance )
    {
        $key = 0;
        $endPoint = self::_lastPoint($points);

        do {
            if ( $key + 1 == $endPoint ) {
                if ( $endPoint != self::_lastPoint($points) ) {
                    $key = $endPoint;
                    $endPoint = self::_lastPoint($points);
                } else {
                    /* Ignore */
                }
            } else {
                $line = new Line($points[$key], $points[$endPoint]);
                $maxIndex = $key + 1;
                $d = Math::shortestDistanceToSegment($points[$maxIndex], $line);
                $maxD = $d;
                for ( $i = $maxIndex + 1; $i < $endPoint; $i++ ) {
                    $d = Math::shortestDistanceToSegment($points[$i], $line);
                    if ( $d > $maxD ) {
                        $maxD = $d;
                        $maxIndex = $i;
                    }
                }
                if ( $maxD > $tolerance ) {
                    $endPoint--;
                } else {
                    for ( $i = $key + 1; $i < $endPoint; $i++ ) {
                        unset($points[$i]);
                    }
                    $key = $endPoint;
                    $endPoint = self::_lastPoint($points);
                }
            }
        } while ( $key < self::_lastPoint($points, -2)
                  || $endPoint != self::_lastPoint($points) );
        return array_values($points);
    }

    static private function _lastPoint( $points, $index = -1 )
    {
        return key(array_slice($points, $index, 1, true));
    }
}
