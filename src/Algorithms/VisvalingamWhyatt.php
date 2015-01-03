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
 * Visvalingam-Whyatt simplification algorithm file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage VisvalingamWhyatt
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @link       http://en.wikipedia.org/wiki/Ramer–Douglas–Peucker_algorithm
 */

namespace PointReduction\Algorithms;
use PointReduction\Common\Math,
    PointReduction\Common\Line;

/**
 * Visvalingam-Whyatt simplification algorithm class
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage VisvalingamWhyatt
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @see        PointReduction\Algorithms\Protocol
 */
class VisvalingamWhyatt implements Protocol
{
    /**
     * Reduce points with Visvalingam-Whyatt algorithm.
     *
     * @param array   $points Finite set of points
     * @param integer $target Desired count of points
     *
     * @return array Reduced set of points
     */
    static public function apply( $points, $target )
    {
        $kill = count($points) - $target;
        while ( $kill-- > 0 ) {
            $idx = 1;
            $minArea = Math::areaOfTriangle(
                $points[0],
                $points[1],
                $points[2]
            );
            foreach (range(2, Math::lastKey($points, -2)) as $segment) {
                $area = Math::areaOfTriangle(
                    $points[$segment - 1],
                    $points[$segment],
                    $points[$segment + 1]
                );
                if ( $area < $minArea ) {
                    $minArea = $area;
                    $idx = $segment;
                }
            }
            array_splice($points, $idx, 1);
        }
        return $points;
    }
}
