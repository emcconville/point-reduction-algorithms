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
 * Lang simplification algorithm file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage Lang
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @link       http://en.wikipedia.org/wiki/Ramer–Douglas–Peucker_algorithm
 */

namespace PointReduction\Algorithms;

/**
 * Lang simplification algorithm class
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage Lang
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @see        PointReduction\Algorithms\Protocol
 */
class Lang extends Abstraction
{
    /**
     * Reduce points with Lang algorithm.
     *
     * @param mixed $tolerance Defined threshold to reduce by
     *
     * @return array Reduced set of points
     */
    public function reduce( $tolerance )
    {
        $key = 0;
        $endPoint = $this->lastKey();

        do {
            if ( $key + 1 == $endPoint ) {
                if ( $endPoint != $this->lastKey() ) {
                    $key = $endPoint;
                    $endPoint = $this->lastKey();
                } else {
                    /* Ignore */
                }
            } else {
                $maxIndex = $key + 1;
                $d = $this->shortestDistanceToSegment(
                    $this->points[$maxIndex],
                    $this->points[$key],
                    $this->points[$endPoint]
                );
                $maxD = $d;
                for ( $i = $maxIndex + 1; $i < $endPoint; $i++ ) {
                    $d = $this->shortestDistanceToSegment(
                        $this->points[$i],
                        $this->points[$key],
                        $this->points[$endPoint]
                    );
                    if ( $d > $maxD ) {
                        $maxD = $d;
                        $maxIndex = $i;
                    }
                }
                if ( $maxD > $tolerance ) {
                    $endPoint--;
                } else {
                    for ( $i = $key + 1; $i < $endPoint; $i++ ) {
                        unset($this->points[$i]);
                    }
                    $key = $endPoint;
                    $endPoint = $this->lastKey();
                }
            }
        } while ( $key < $this->lastKey(-2)
                  || $endPoint != $this->lastKey() );
        return $this->reindex();
    }
}
