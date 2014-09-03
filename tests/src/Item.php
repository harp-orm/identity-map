<?php

namespace Harp\IdentityMap\Test;

use Harp\IdentityMap\ItemInterface;

/**
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class Item implements ItemInterface
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
