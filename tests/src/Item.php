<?php

namespace Harp\IdentityMap\Test;

use Harp\IdentityMap\IdentityMapItemInterface;

/**
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014-2015 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class Item
{
    private $identityKey;

    public function __construct($identityKey = null)
    {
        $this->identityKey = $identityKey;
    }

    public function getIdentityKey()
    {
        return $this->identityKey;
    }
}
