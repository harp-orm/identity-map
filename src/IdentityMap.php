<?php

namespace Harp\IdentityMap;

/**
 * Each loaded item is passed through the IdentityMap. If another item with the same ID is already present,
 * then that item is returned. This means that you will retrieve the same object each time you load items
 * with the same ID.
 *
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class IdentityMap
{
    /**
     * @var ItemInterface[]
     */
    private $items = [];

    /**
     * @var ItemInterface[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * If a item with the same key already exist in the identity map return that item.
     * Only handle items that have non-null keys
     *
     * @param  ItemInterface $item
     * @return ItemInterface
     */
    public function get(ItemInterface $item)
    {
        $key = $item->getIdentityKey();

        if ($key !== null) {
            if (isset($this->items[$key])) {
                $item = $this->items[$key];
            } else {
                $this->items[$key] = $item;
            }
        }

        return $item;
    }

    /**
     * @param  ItemInterface $item
     * @return boolean
     */
    public function has(ItemInterface $item)
    {
        $key = $item->getIdentityKey();

        return $key === null
            ? null
            : isset($this->items[$key]);
    }

    /**
     * Call the "get" method for a whole array of items
     *
     * @param  ItemInterface[] $items
     * @return ItemInterface[]
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
