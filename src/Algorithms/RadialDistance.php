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
 * Radial Distance simplification algorithm file.
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage RadialDistance
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

namespace PointReduction\Algorithms;

use PointReduction\Common\PointInterface;

/**
 * Radial Distance algorithm class.
 *
 * A quick & simple reduction method.
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage RadialDistance
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @version    Release: 1.2.0 
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class RadialDistance extends Abstraction
{
    /**
     * Remove points with a distance under a given tolerance.
     *
     * @param double $tolerance Maximum radial distance between points.
     *
     * @return array Reduced set of points
     */
    public function reduce( $tolerance )
    {
        $sentinelKey = 0;
        while ($sentinelKey < $this->count()-1) {
            $testKey = $sentinelKey + 1;
            while ( $sentinelKey < $this->count()-1
                && $this->distanceBetweenPoints($this->points[$sentinelKey],
                                                $this->points[$testKey]) < $tolerance )
            {
                unset($this->points[$testKey]);
                $testKey++;
            }
            $this->reindex();
            $sentinelKey++;
        }
        return $this->reindex();
    }
}
