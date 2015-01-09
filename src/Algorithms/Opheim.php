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
class Opheim Extends Abstraction
{
    /**
     * Reduce points with Opheim algorithm.
     *
     * @param double $p Defined Perpendicular tolerance
     * @param double $r Defined Radial tolerance
     *
     * @return array Reduced set of points
     */
    public function reduce( $p, $r )
    {
        $p = (double)$p;
        $r = (double)$r;
        $key = 0;
        while ( $key < $this->lastKey(-3) ) {
            $out = $key + 2;
            while (
                $out < $this->lastKey()
                && $this->_shortest($out, $key) < $p
                && $this->_distance($out, $key) < $r
            ) {
                $out++;
            }
            for ( $i = $key+1, $l = $out - 1; $i < $l; $i++ ) {
                unset($this->points[$i]);
            }
            $this->reindex();
            $key++;
        }
        return $this->points;
    }

    /**
     * Short-cut function for shortestDistanceToSegment method
     *
     * @param integer $out Test point-index
     * @param integer $key Index point-index (what???)
     *
     * @return double
     */
    private function _shortest( $out, $key )
    {
        return $this->shortestDistanceToSegment(
            $this->points[$out],
            $this->points[$key],
            $this->points[$key + 1]
        );
    }

    /**
     * Short-cut function for distanceBetweenPoints method
     *
     * @param integer $out Test point-index
     * @param integer $key Index point-index (what???)
     *
     * @return double
     */
    private function _distance( $out, $key )
    {
        return $this->distanceBetweenPoints(
            $this->points[$out],
            $this->points[$key]
        );
    }
}