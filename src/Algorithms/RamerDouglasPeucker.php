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
 * RamerDouglasPeucker simplification algorithm file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage RamerDouglasPeucker
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @link       http://en.wikipedia.org/wiki/Ramer–Douglas–Peucker_algorithm
 */

namespace PointReduction\Algorithms;
use PointReduction\Common\Math,
    PointReduction\Common\Line;

/**
 * RamerDouglasPeucker simplification algorithm class
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage RamerDouglasPeucker
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @see        PointReduction\Algorithms\Protocol
 */
class RamerDouglasPeucker implements Protocol
{
    /**
     * Reduce points with Ramer-Douglas-Peucker algorithm.
     *
     * @param array $points    Finite set of points
     * @param mixed $tolerance Defined threshold to reduce by
     *
     * @return array            Reduced set of points
     */
    static public function apply( $points, $tolerance )
    {
        $distanceMax = $index = 0;
        $pointsEnd = key(array_slice($points, -1, 1, true));
        $resultingPoints = $points;
        for ( $i = 1; $i < $pointsEnd; $i++ ) {
            $distance = Math::shortestDistanceToSegment(
                $points[$i],
                new Line($points[0], $points[$pointsEnd])
            );
            if ( $distance > $distanceMax ) {
                $index = $i;
                $distanceMax = $distance;
            }
        }

        if ( $distanceMax > $tolerance ) {
            $firstHalf = self::apply(
                array_slice($points, 0, $index+1),
                $tolerance
            );
            $secondHalf = self::apply(array_slice($points, $index), $tolerance);
            $resultingPoints = array_merge($firstHalf, array_slice($secondHalf, 1));
        } else {
            $resultingPoints = array($points[0], $points[$pointsEnd]);
        }
        return $resultingPoints;
    }
}
