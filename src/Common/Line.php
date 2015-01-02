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
 * Line class file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Common
 * @subpackage Line
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
 * @subpackage Line
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
class Line
{
    public $head, $tail;

    /**
     * Allocate & init Line object
     *
     * @param PointReduction\Common\Point $head Starting point of line
     * @param PointReduction\Common\Point $tail Ending point of line
     * @return PointReduction\Common\Line
     */
    public function __construct(Point $head, Point $tail)
    {
        $this->head = $head;
        $this->tail = $tail;
    }
}