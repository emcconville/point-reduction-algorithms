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
 * Zhao-Saalfeld simplification algorithm file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage ZhaoSaalfeld
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */

namespace PointReduction\Algorithms;

use PointReduction\Common\PointInterface;

/**
 * Zhao-Saalfeld simplification algorithm class.
 *
 * A slightly modified version of Zhao & Saalfeld's
 * "Linear-time Sleeve-fitting Polyline Simplification Algorithms".
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage ZhaoSaalfeld
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @version    Release: 1.2.0 
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class ZhaoSaalfeld extends Abstraction
{
    public $lookAhead = 7;
    /**
     * Reduce points with modified version of Zhao-Saalfeld simplification.
     *
     * @param double  $degree    Angle between 0 & 360 to compare points.
     * @param integer $lookAhead Number of points to include in each sector
     *                           bound iteration.
     *
     * @return array Reduced set of points
     */
    public function reduce( $degree, $lookAhead=null )
    {
        if ($lookAhead) {
            $this->lookAhead = (int)$lookAhead;
        }
        $epsilon = deg2rad($degree);
        $results = array();
        for ($i = 0; $i < $this->count(); $i++) {
            $j = min($i + $this->lookAhead, $this->lastKey());
            $basePoint = $this->points[$i];
            $results[] = $basePoint;
            $boundPoint = $this->points[$j];
            $theta = $this->_theta($basePoint, $boundPoint);
            $a1 = $theta - $epsilon;
            $a2 = $theta + $epsilon;

            while (++$i < $j) {
                $testPoint = $this->points[$i];
                $delta = $this->_theta($basePoint, $testPoint);
                if ($a1 < $delta && $delta < $a2) {
                    // Ommit this point
                } else {
                    // This point is outside of the sleeve.
                    // Make this point the new base point.
                    break;
                }
            }
            $i--; // Backup iterator
        }
        return $this->points = $results;
    }

    /**
     * Calculate the angle, and add 2pi to protect against underflow.
     *
     * @param PointInterface $a Base coordinate point.
     * @param PointInterface $b Subject coordinate point.
     *
     * @return double None negative radian.
     */
    private function _theta(PointInterface $a, PointInterface $b)
    {
        list($x1, $y1) = $a->getCoordinates();
        list($x2, $y2) = $b->getCoordinates();
        return atan2($y2-$y1, $x2 - $x1) + 2 * M_PI;
    }
}
