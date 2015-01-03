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
 * Simplification algorithm protocol file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage Protocol
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @link       http://en.wikipedia.org/wiki/Ramer–Douglas–Peucker_algorithm
 */

namespace PointReduction\Algorithms;

/**
 * Protocol interface for all algorithms to follow.
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage Protocol
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 *
 * @codeCoverageIgnore
 */
interface Protocol
{
    /**
     * Reduce given points by used of sub-class algorithm
     *
     * @param array $points    Finite set of points
     * @param mixed $tolerance Defined threshold to reduce by
     *
     * @return array
     */
    static public function apply( $points, $tolerance );
}