<?php

namespace Harp\IdentityMap;

/**
 * Each loaded item is passed through the IdentityMap. If another item with the same ID is already present,
 * then that item is returned. This means that you will retrieve the same object each time you load items
 * with the same ID.
 *
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014-2015 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class IdentityMap
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @var array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * A callback to retrieve the items' id
     *
     * Example:
     *
     * function (Model $item) {
     *     return $item->getId();
     * }
     *
     * @var callable
     */
    private $identityCallback;

    /**
     * @param callable $identityCallback
     */
    public function __construct(callable $identityCallback)
    {
        $this->identityCallback = $identityCallback;
    }

    /**
     * @param  mixed $item
     * @return mixed
     */
    public function getItemKey($item)
    {
        $callback = $this->identityCallback;

        return $callback($item);
    }

    /**
     * If a item with the same key already exist in the identity map return that item.
     * Only handle items that have non-null keys
     *
     * @param  mixed $item
     * @return mixed
     */
    public function get($item)
    {
        $key = $this->getItemKey($item);

        if (null !== $key) {
            if (isset($this->items[$key])) {
                $item = $this->items[$key];
            } else {
                $this->items[$key] = $item;
            }
        }

        return $item;
    }

    /**
     * @param  mixed   $item
     * @return boolean
     */
    public function has($item)
    {
        $key = $this->getItemKey($item);

        if (null !== $key) {
            return isset($this->items[$key]);
        }

        return false;
    }

    /**
     * Call the "get" method for a whole array of items
     *
     * @param  array $items
     * @return array
     */
    public function getArray(array $items)
    {
        return array_map(function ($item) {
            return $this->get($item);
        }, $items);
    }

    /**
     * @return IdentityMap $this
     */
    public function clear()
    {
        $this->items = [];

        return $this;
    }
}
