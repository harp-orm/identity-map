<?php

namespace Harp\IdentityMap\Test;

use Harp\IdentityMap\IdentityMap;

/**
 * @coversDefaultClass Harp\IdentityMap\IdentityMap
 *
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class IdentityMapTest extends AbstractTestCase
{
    /**
     * @covers ::getItems
     */
    public function testGetItems()
    {
        $map = new IdentityMap();

        $item1 = new Item(1);
        $item2 = new Item(2);

        $map->get($item1);
        $map->get($item2);

        $this->assertEquals(
            [
                $item1->getIdentityKey() => $item1,
                $item2->getIdentityKey() => $item2,
            ],
            $map->getItems()
        );
    }

    /**
     * @covers ::get
     */
    public function testGet()
    {
        $map = new IdentityMap();

        $item1 = new Item(1);
        $item2 = new Item(1);
        $item3 = new Item(2);
        $item4 = new Item(null);

        $this->assertSame($item1, $map->get($item1));
        $this->assertSame($item1, $map->get($item2));
        $this->assertSame($item3, $map->get($item3));
        $this->assertSame($item4, $map->get($item4));
    }

    /**
     * @covers ::getArray
     */
    public function testGetArray()
    {
        $map = $this->getMock('Harp\IdentityMap\IdentityMap', ['get']);

        $item1 = new Item();
        $item2 = new Item();

        $item3 = new Item();
        $item4 = new Item();

        $map
            ->expects($this->exactly(2))
            ->method('get')
            ->will($this->returnValueMap([
                [$item1, $item3],
                [$item2, $item4],
            ]));

        $this->assertSame([$item3, $item4], $map->getArray([$item1, $item2]));
    }

    /**
     * @covers ::has
     */
    public function testHas()
    {
        $map = new IdentityMap();

        $item = new Item(1);

        $this->assertFalse($map->has($item));

        $map->get($item);

        $this->assertTrue($map->has($item));
    }

    /**
     * @covers ::clear
     */
    public function testClear()
    {
        $map = new IdentityMap();

        $item1 = new Item(1);
        $item2 = new Item(2);

        $map->get($item1);
        $map->get($item2);

        $this->assertCount(2, $map->getItems());
        $map->clear();
        $this->assertCount(0, $map->getItems());
    }
}