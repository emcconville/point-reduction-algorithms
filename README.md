#Point Reduction Algorithms

A collection of algorithms for reducing the number of points in polygon / polyline.

Custom shapes, polygon & polyline in web-map applications, can have **too many**
points. Often a shape will be rendered at a distant zoom-level, and wouldn't
require such high-resolution. This library's goal is to provided basic methods
to simplify & reduce shapes.

[![Build Status](https://travis-ci.org/emcconville/point-reduction-algorithms.svg?branch=master)](https://travis-ci.org/emcconville/point-reduction-algorithms)
[![Coverage Status](https://img.shields.io/coveralls/emcconville/point-reduction-algorithms.svg)](https://coveralls.io/r/emcconville/point-reduction-algorithms?branch=master)


## Install


With [composer](https://github.com/composer/composer).

    $ curl -sS https://getcomposer.org/installer | php
    $ cat > composer.json <<EOF
    {
       "require": {
          "emcconville/point-reduction-algorithms" : "~1.0"
       }
    }
    EOF
    $ php composer.phar install

## Algorithms & Usage

Below is an original, uncompressed, polyline with 2151 points, and is delivered
as SVG weighing in @ 175K.

![Original example](http://emcconville.com/point-reduction-algorithms/examples/dayton_original.svg)

All algorithms share a common abstraction, but each class implements a unique
*reduce* method. Most reduction methods require one argument for tolerance /
threshold; except, Visvalingam–Whyatt requires the desired final point count,
and Opheim requires two independent thresholds.

**Example Pseudo code:**

```php
use PointReduction\Algorithms\ALGORITHM_NAME;
$obj = new ALGORITHM_NAME($myPoints);
$myReducedPoints = $obj->reduce($tolerance);
```

The **$myPoints** must be an array, or traversable object that supports removing
element at index. Each user defined point must implement
**PointReduction\Common\PointInterface** which enforces a **getCoordinates**
method. This common interface allows user objects to have any type of property
(ie. x/y, latitude/longitude, left/top).

```php
class MyPoint implements PointReduction\Common\PointInterface
{
    // ... my stuff here ...
    public function getCoordinates() {
        return array($this->myOwnX, $this->myOwnY);
    }
}
```

### Ramer–Douglas–Peucker

```php
use PointReduction\Common\Point,
    PointReduction\Algorithms\RamerDouglasPeucker;
$givenPoints = array(
    new Point(-84.158640, -39.822480),
    new Point(-84.159250, -39.820120),
    // ... and so one
);
$epsilon = 0.001
$reducer = new RamerDouglasPeucker($givenPoints);
$reducedPoints = $reducer->reduce($epsilon);
```

The original polygon of 2151 points has been reduced to 343.

![Ramer–Douglas–Peucker example](http://emcconville.com/point-reduction-algorithms/examples/dayton_RamerDouglasPeucker.svg)

### Visvalingam–Whyatt

```php
use PointReduction\Common\Point,
    PointReduction\Algorithms\VisvalingamWhyatt;
$givenPoints = array(
    new Point(-84.158640, -39.822480),
    new Point(-84.159250, -39.820120),
    // ... and so one
);
$desiredPointCount = 343;
$reducer = new VisvalingamWhyatt($givenPoints);
$reducedPoints = $reducer->reduce($desiredPointCount);
```

The original polygon of 2151 points has been reduced to 343.

![Visvalingam–Whyatt example](http://emcconville.com/point-reduction-algorithms/examples/dayton_VisvalingamWhyatt.svg)

### Reumann–Witkam

```php
use PointReduction\Common\Point,
    PointReduction\Algorithms\ReumannWitkam;
$givenPoints = array(
    new Point(-84.158640, -39.822480),
    new Point(-84.159250, -39.820120),
    // ... and so one
);
$threshold = 0.001;
$reducer = new ReumannWitkam($givenPoints);
$reducedPoints = $reducer->reduce($threshold);
```

The original polygon of 2151 points has been reduced to 872.

![Reumann–Witkam example](http://emcconville.com/point-reduction-algorithms/examples/dayton_ReumannWitkam.svg)

### Opheim

```php
use PointReduction\Common\Point,
    PointReduction\Algorithms\Opheim;
$givenPoints = array(
    new Point(-84.158640, -39.822480),
    new Point(-84.159250, -39.820120),
    // ... and so one
);
$perpendicularTolerance = 0.005;
$radialTolerance = 0.01;
$reducer = new Opheim($givenPoints);
$reducedPoints = $reducer->reduce($perpendicularTolerance, $radialTolerance);
```

The original polygon of 2151 points has been reduced to 684.

![Opheim example](http://emcconville.com/point-reduction-algorithms/examples/dayton_Opheim.svg)

### Lang 

```php
use PointReduction\Common\Point,
    PointReduction\Algorithms\Lang;
$givenPoints = array(
    new Point(-84.158640, -39.822480),
    new Point(-84.159250, -39.820120),
    // ... and so one
);
$threshold = 0.001;
$reducer = new Lang($givenPoints);
$reducedPoints = $reducer->reduce($threshold);
```

The original polygon of 2151 points has been reduced to 293.

![Lang example](http://emcconville.com/point-reduction-algorithms/examples/dayton_Lang.svg)
