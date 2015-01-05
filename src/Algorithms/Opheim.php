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
 * Opheim simplification algorithm file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage Opheim
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @link       http://en.wikipedia.org/wiki/Ramer–Douglas–Peucker_algorithm
 */

namespace PointReduction\Algorithms;
use PointReduction\Common\Math,
    PointReduction\Common\Line;

/**
 * Opheim simplification algorithm class
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage Opheim
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @see        PointReduction\Algorithms\Protocol
 */
class Opheim implements Protocol
{
    /**
     * Reduce points with Opheim algorithm.
     *
     * @param array $points    Finite set of points
     * @param mixed $tolerance Defined threshold to reduce by
     *
     * @return array            Reduced set of points
     */
    static public function apply( $points, $tolerance )
    {
        if ( is_array($tolerance) ) {
            // Perpendicular tolerance
            $p = (double)array_shift($tolerance);
            // Radial tolerance
            $r = (double)array_shift($tolerance);
        } else {
            throw new Exception("Opheim requires a pair of tolerances.");
        }
        $key = 0;
        while ( $key < Math::lastKey($points, -3) ) {
            $line = new Line($points[$key], $points[$key + 1]);
            $out = $key + 2;
            while (
                $out < Math::lastKey($points)
                &&  Math::shortestDistanceToSegment($points[$out], $line) < $p
                && Math::distanceBetweenPoints($points[$key], $points[$out]) < $r 
            ) {
                $out++;
            }
            for ( $i = $key+1, $l = $out - 1; $i < $l; $i++ ) {
                unset($points[$i]);
            }
            // Re-index points
            $points = array_values($points);
            $key++;
        }
        return $points;
    }
}