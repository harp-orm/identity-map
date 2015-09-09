Identity Map
============

[![Build Status](https://travis-ci.org/harp-orm/identity-map.png?branch=master)](https://travis-ci.org/harp-orm/identity-map)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/harp-orm/identity-map/badges/quality-score.png)](https://scrutinizer-ci.com/g/harp-orm/identity-map/)
[![Code Coverage](https://scrutinizer-ci.com/g/harp-orm/identity-map/badges/coverage.png)](https://scrutinizer-ci.com/g/harp-orm/identity-map/)
[![Latest Stable Version](https://poser.pugx.org/harp-orm/identity-map/v/stable.png)](https://packagist.org/packages/harp-orm/identity-map)

This package allows having "canonical objects".

Usage
-----

Assuming "new Item(1)" will have id of "1":

```php
$map = new IdentityMap(function ($item) {
    return $item->getId();
});

$item1 = new Item(1);
$item2 = new Item(1);
$item3 = new Item(2);

echo $map->get($item1); // Will return item1
echo $map->get($item2); // Will return item1
echo $map->get($item3); // Will return item3
```

That way you can make sure items with the same key are the same physical objects

--------

The closure argument that use pass to the identity map, needs to return the "unique key" for each product.

License
-------

Copyright (c) 2014-2015, Clippings Ltd. Developed by [Ivan Kerin](https://github.com/ivank) as part of [Clippings.com](https://clippings.com)

Under BSD-3-Clause license, read LICENSE file.
