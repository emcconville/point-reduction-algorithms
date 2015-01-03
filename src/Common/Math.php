<?php
/**
 * This file is part of Point Reduction Algorithms (PointReduction).
 *
 * PointReduction is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Point Reduction Algorithms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with PointReduction.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Math file
 *
 * Collection of commonly used math functions to be used across algorithm
 * methods. Helper & compatibility methods will also be stored here.
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Common
 * @subpackage Math
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL, version 3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

namespace PointReduction\Common;

 /**
  * Math function collection
  *
  * @category   PointReduction
  * @package    Common
  * @subpackage Math
  * @author     E. McConville <emcconville@emcconville.com>
  * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
  * @link       https://github.com/emcconville/point-reduction-algorithms
  */
class Math
{
    /**
     * Calculate the area of a triangle
     *
     * @param Point $a First point
     * @param Point $b Middle point
     * @param Point $c Last point
     *
     * @return float
     */
    static public function areaOfTriangle( Point $a, Point $b, Point $c)
    {
        $area  = $a->x * ( $b->y - $c->y );
        $area += $b->x * ( $c->y - $a->y );
        $area += $c->x * ( $a->y - $b->y );
        return abs($area / 2);
    }
    /**
     * Calculate the distance between to points
     *
     * @param Point $head First point
     * @param Point $tail Last point
     *
     * @return float
     */
    static public function distanceBetweenPoints( Point $head, Point $tail )
    {
        return pow($head->x - $tail->x, 2) + pow($head->y - $tail->y, 2);
    }

    /**
     * Quickly grab the last key, or index, of a given array
     *
     * This can be used to calculate the size (nth - 1) of an array.
     *
     * @param array   $points Subject list to find last key/index.
     * @param integer $index  Offset to match (default -1).
     *
     * @return integer
     */
    static public function lastKey( $points, $index = -1 )
    {
        return key(array_slice($points, $index, 1, true));
    }

    /**
     * Calculate perpendicular distance between line & point
     *
     * @param Point $p Point of interest
     * @param Point $l Line to evaluate
     *
     * @return float
     */
    static public function shortestDistanceToSegment( Point $p, Line $l )
    {
        $h = $l->head;
        $t = $l->tail;
        $return = 0.0;
        $length = self::distanceBetweenPoints($h, $t);
        if ( $length == 0 ) {
            return sqrt(self::distanceBetweenPoints($p, $h));
        }
        $d  = ( $p->x - $h->x ) * ( $t->x - $h->x );
        $d += ( $p->y - $h->y ) * ( $t->y - $h->y );
        $d /= $length;
        if ( $d < 0 ) {
            $return = self::distanceBetweenPoints($p, $h);
        } elseif ( $d > 1 ) {
            $return = self::distanceBetweenPoints($p, $t);
        } else {
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