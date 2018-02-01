<?php

namespace RssBundle\Tests\Unit\Services\Factory;

use FeedIo\Feed;
use PHPUnit\Framework\TestCase;
use RssBundle\Entity\Item;

use RssBundle\Services\Factory\ItemFactory;

/**
 * Class ItemFactoryTest
 * @package RssBundle\Tests\Unit\Services\Factory
 */
class ItemFactoryTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider()
    {
        $cases = [];

        // Case 0: Nothing changed
        $result = new Item();

        $cases[] = [new Feed\Item(), $result];

        // Case 1: Adding Elements
        $date = new \DateTime('now');

        $item = new Feed\Item();
        $item->setTitle('title');
        $item->setDescription('desc');
        $item->setLink('link');
        $item->setLastModified($date);

        $result = new Item();
        $result->setTitle('title');
        $result->setDescription('desc');
        $result->setLink('link');
        $result->setPublished($date);

        $cases[] = [$item, $result];
        return $cases;
    }

    /**
     * @param Feed\Item $feed
     * @param Item $expected
     *
     * @dataProvider dataProvider
     */
    public function testFactory(Feed\Item $feed, Item $expected)
    {
        $factory = new ItemFactory();
        $result = $factory->build($feed);

        $this->assertEquals($expected, $result);
    }
}
