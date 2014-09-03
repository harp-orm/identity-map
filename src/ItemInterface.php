<?php

namespace Harp\IdentityMap;

/**
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
interface ItemInterface
{
    /**
     * @return string|null
     */
    public function getIdentityKey();
}
