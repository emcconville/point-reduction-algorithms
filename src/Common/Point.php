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
 * Point class file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Common
 * @subpackage Point
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

namespace PointReduction\Common;

/**
 * Simple Line structure
 *
 * @category   PointReduction
 * @package    Common
 * @subpackage Point
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class Point implements PointInterface
{
    public $x, $y;

    /**
     * Allocate & init Point object
     *
     * @param double $x Horizontal quantum
     * @param double $y Vertical quantum
     *
     * @return Point
     */
    public function __construct( $x, $y )
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Return a basic non-associated array of point coordinates.
     *
     * @return array
     */
    public function getCoordinates()
    {
        return array($this->x, $this->y);
    }

    /**
     * Return a basic string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%.6g,%.6g', $this->x, $this->y);
    }
}
