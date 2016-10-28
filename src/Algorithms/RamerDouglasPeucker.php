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

/**
 * RamerDouglasPeucker simplification algorithm class
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage RamerDouglasPeucker
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class RamerDouglasPeucker extends Abstraction
{
    /**
     * Public visible method to reduce points.
     *
     * @param mixed $tolerance Defined threshold to reduce by
     *
     * @return array            Reduced set of points
     */
    public function reduce( $tolerance )
    {
        $this->points = $this->_reduce($this->points, (double)$tolerance);
        return $this->points;
    }

    /**
     * Reduce points with Ramer-Douglas-Peucker algorithm.
     *
     * @param array $points    Finite set of points
     * @param mixed $tolerance Defined threshold to reduce by
     *
     * @return array            Reduced set of points
     */
    private function _reduce( $points, $tolerance )
    {
        $distanceMax = $index = 0;
        // Can't user $this->lastkey, as this is a reclusive method.
        $pointsEnd = key(array_slice($points, -1, 1, true));
        for ( $i = 1; $i < $pointsEnd; $i++ ) {
            $distance = $this->shortestDistanceToSegment(
                $points[$i],
                $points[0],
                $points[$pointsEnd]
            );
            if ( $distance > $distanceMax ) {
                $index = $i;
                $distanceMax = $distance;
            }
        }

        if ( $distanceMax > $tolerance ) {
            $firstHalf = $this->_reduce(
                array_slice($points, 0, $index+1),
                $tolerance
            );
            $secondHalf = $this->_reduce(
                array_slice($points, $index),
                $tolerance
            );
            array_shift($secondHalf);
            $points = array_merge($firstHalf, $secondHalf);
        } else {
            $points = array($points[0], $points[$pointsEnd]);
        }
        return $points;
    }
}
