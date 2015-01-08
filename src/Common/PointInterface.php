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
 * Point interface file
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
 * Common Point interface
 *
 * @category   PointReduction
 * @package    Common
 * @subpackage PointInterface
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
interface PointInterface
{
    /**
     * Return a basic non-associated array of point coordinates.
     *
     * As the definition of a point can vary between applications, this
     * interface allows a common gateway method to retrieving point data in a
     * normalized pattern.
     * Example:
     * <code>
     * <?php
     * class LatLon extends PointReduction\Common\PointInterface {
     *   // ...
     *   public function getCoordinates() {
     *     return array($this->latitude, $this->longitude);
     *   }
     * }
     * ?>
     * </code>
     *
     * @return array
     */
    public function getCoordinates();
}