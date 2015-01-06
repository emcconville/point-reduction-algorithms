#Point Reduction Algorithms

A collection of algorithms for reducing the number of points in polyline

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
$reducedPoints = RamerDouglasPeucker::apply($givenPoints, $epsilon);
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
$reducedPoints = VisvalingamWhyatt::apply($givenPoints, 343);
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
$reducedPoints = ReumannWitkam::apply($givenPoints, $threshold);
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
$threshold = 0.001;
$reducedPoints = Opheim::apply($givenPoints, $threshold);
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
$reducedPoints = Lang::apply($givenPoints, $threshold);
```

The original polygon of 2151 points has been reduced to 293.

![Lang example](http://emcconville.com/point-reduction-algorithms/examples/dayton_Lang.svg)
