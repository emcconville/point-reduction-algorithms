<?php

namespace PointReduction\Algorithms;
use PointReduction\Common\Math,
    PointReduction\Common\Line;

class RamerDouglasPeucker
{
    static public function apply( $points, $epsilon )
    {
        $distanceMax = $index = 0;
        $pointsEnd = key(array_slice($points, -1, 1, true));
        $resultingPoints = $points;
        for ( $i = 1; $i < $pointsEnd; $i++ )
        {
            $distance = Math::shortestDistanceToSegment(
                $points[$i],
                new Line($points[0], $points[$pointsEnd])
            );
            if ( $distance > $distanceMax ) {
                $index = $i;
                $distanceMax = $distance;
            }
        }

        if ( $distanceMax > $epsilon ) {
            $firstHalf   = self::apply(
                array_slice($points, 0, $index+1),
                $epsilon
            );
            $secondHalf = self::apply(array_slice($points, $index), $epsilon);
            $resultingPoints = array_merge($firstHalf, array_slice($secondHalf, 1));
        } else {
            $resultingPoints = array($points[0], $points[$pointsEnd]);
        }
        return $resultingPoints;
    }
}
