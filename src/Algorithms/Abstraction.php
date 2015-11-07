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
 * Simplification algorithm abstraction file
 *
 * PHP Version 5.4
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage Abstraction
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 * @link       http://en.wikipedia.org/wiki/Ramer–Douglas–Peucker_algorithm
 */

namespace PointReduction\Algorithms;
use PointReduction\Common\PointInterface,
    PointReduction\Common\Point;

/**
 * Abstraction class for all algorithms to inherit.
 *
 * @category   PointReduction
 * @package    Algorithms
 * @subpackage Abstraction
 * @author     E. McConville <emcconville@emcconville.com>
 * @license    https://www.gnu.org/licenses/lgpl.html GNU LGPL v3
 * @link       https://github.com/emcconville/point-reduction-algorithms
 */
abstract class Abstraction implements \Countable
{
    /**
     * Property for holding subject points
     */
    protected $points;

    /**
     * Allocate & Initialize sub-class
     *
     * @param array $points Optional subject points.
     *
     * @return Abstraction subclass
     */
    public function __construct( $points = null )
    {
        $this->points = array();
        if ( $points ) {
            $this->setPoints($points);
        }
    }

    /**
     * Set subject points
     *
     * @param mixed $points Must be array or Traversable
     *
     * @return null
     */
    public function setPoints( $points )
    {
        if ( is_array($points) || $points instanceof Traversable ) {
            array_walk(
                $points,
                function ($point, $index) {
                    if ( !$point instanceof PointInterface ) {
                        $msg = "Point at index #$index does not implement "
                             . "PointReduction\\Common\\PointInterface";
                        throw new InvalidArgumentException($msg);
                    }
                }
            );
            $this->points = $points;
        } else {
            $msg = "All points must be a traversable object, or array. "
                 . gettype($points)
                 . " given.";
            throw new InvalidArgumentException($msg);
        }
    }

    /**
     * Calculate the area of a triangle
     *
     * @param Point $a First point
     * @param Point $b Middle point
     * @param Point $c Last point
     *
     * @return float
     */
    protected function areaOfTriangle(
        PointInterface $a,
        PointInterface $b,
        PointInterface $c
    ): float {
        list( $ax, $ay ) = $a->getCoordinates();
        list( $bx, $by ) = $b->getCoordinates();
        list( $cx, $cy ) = $c->getCoordinates();
        $area  = $ax * ( $by - $cy );
        $area += $bx * ( $cy - $ay );
        $area += $cx * ( $ay - $by );
        return (float)abs($area / 2);
    }

    /**
     * Send all `count' methods directly to points property
     *
     * @return integer
     */
    public function count(): int
    {
        return count($this->points);
    }

    /**
     * Calculate the distance between to points
     *
     * @param Point $head First point
     * @param Point $tail Last point
     *
     * @return float
     */
    protected function distanceBetweenPoints(
        PointInterface $head,
        PointInterface $tail
    ): float {
        return sqrt(self::pythagorus($head, $tail));
    }

    /**
     * Quickly grab the last key, or index, of a given array
     *
     * This can be used to calculate the size (nth - 1) of an array.
     *
     * @param integer $index Offset to match (default -1).
     *
     * @return integer
     */
    protected function lastKey( $index = -1 ): int
    {
        return key(array_slice($this->points, $index, 1, true));
    }

    /**
     * Calculate Pythagoras distance.
     *
     * Pythagorus as described as "a^2 + b^2 = c^2"
     *
     * @param PointInterface $a First point
     * @param PointInterface $b Last point
     *
     * @return float
     */
    protected function pythagorus(
        PointInterface $a,
        PointInterface $b
    ): float {
        list( $ax, $ay ) = $a->getCoordinates();
        list( $bx, $by ) = $b->getCoordinates();
        return pow($ax - $bx, 2) + pow($ay - $by, 2);
    }

    /**
     * Reindex point keys to match value order.
     *
     * @return array
     */
    public function reindex(): array
    {
        return $this->points = array_values($this->points);
    }

    /**
     * Calculate perpendicular distance between line & point
     *
     * @param PointInterface $a Point of interest
     * @param PointInterface $b Head of line to evaluate
     * @param PointInterface $c Tail of line to evaluate
     *
     * @return float
     */
    protected function shortestDistanceToSegment(
        PointInterface $a,
        PointInterface $b,
        PointInterface $c
    ): float {
        list( $ax, $ay ) = $a->getCoordinates();
        list( $bx, $by ) = $b->getCoordinates();
        list( $cx, $cy ) = $c->getCoordinates();
        $return = 0.0;
        $length = self::pythagorus($b, $c);
        if ( $length == 0 ) {
            return self::distanceBetweenPoints($a, $b);
        }
        $d  = ( $ax - $bx ) * ( $cx - $bx );
        $d += ( $ay - $by ) * ( $cy - $by );
        $d /= $length;
        if ( $d < 0 ) {
            $return = self::distanceBetweenPoints($a, $b);
        } elseif ( $d > 1 ) {
            $return = self::distanceBetweenPoints($a, $c);
        } else {
            $return = self::distanceBetweenPoints(
                $a,
                new Point(
                    $bx + $d * ($cx - $bx),
                    $by + $d * ($cy - $by)
                )
            );
        }
        return $return;
    }
}