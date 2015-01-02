<?php

namespace PointReduction\Common;

class Math
{
    static public function distanceBetweenPoints(Point $head, Point $tail)
    {
        return pow($head->x - $tail->x, 2) + pow($head->y - $tail->y, 2);
    }
    static public function shortestDistanceToSegment( Point $p, Point $h, Point $t )
    {
        $return = 0.0;
        $length = self::distanceBetweenPoints($h, $t);
        if ($length == 0) { return sqrt(self::distanceBetweenPoints($p, $h)); 
        }
        $d = (
          ( $p->x - $h->x ) * ( $t->x - $h->x )
          + ($p->y - $h->y ) * ( $t->y - $h->y )
         ) / $length;
        if ( $d < 0 ) { $return = self::distanceBetweenPoints($p, $h); 
        }
        elseif ( $d > 1 ) { $return = self::distanceBetweenPoints($p, $t); 
        }
        else {
            $return = self::distanceBetweenPoints(
                $p,
                new Point(
                    $h->x + $d * ($t->x - $h->x),
                    $h->y + $d * ($t->y - $h->y)
                )
            );
        }
        return sqrt($return);
    }
}