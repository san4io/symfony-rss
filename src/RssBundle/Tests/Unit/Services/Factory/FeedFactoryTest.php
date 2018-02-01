<?php

namespace RssBundle\Tests\Unit\Services\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use FeedIo\Feed as RssFeed;
use PHPUnit\Framework\TestCase;
use RssBundle\Entity\Feed;
use RssBundle\Entity\Item;
use RssBundle\Services\Factory\EntityFactoryInterface;
use RssBundle\Services\Factory\FeedFactory;
use RssBundle\Services\Factory\ItemFactory;

/**
 * Class FeedFactoryTest
 * @package RssBundle\Tests\Unit\Services\Factory
 */
class FeedFactoryTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider()
    {
        $cases = [];

        // Case 0: Empty RssFeed
        $feed = new RssFeed;

        $result = new Feed();

        $cases[] = [$feed, 0, $result];

        // Case 1: Full Rss Feed
        $date = new \DateTime('now');

        $feed = new RssFeed;
        $feed->set('url', 'url');
        $feed->set('category', 'cat');
        $feed->setTitle('title');
        $feed->setLastModified($date);
        $feed->add(new RssFeed\Item());
        $feed->add(new RssFeed\Item());
        $feed->add(new RssFeed\Item());

        $result = new Feed();
        $result->setUrl('url');
        $result->setCategory('cat');
        $result->setTitle('title');
        $result->setLastUpdate($date);
        $result->setItems(new ArrayCollection([new Item(), new Item(), new Item()]));

        $cases[] = [$feed, 3, $result];

        return $cases;
    }

    /**
     * @param RssFeed $feed
     * @param int $times
     * @param Feed $expected
     *
     * @dataProvider dataProvider
     */
    public function testFactory(RssFeed $feed, int $times, Feed $expected)
    {
        $factory = new FeedFactory($this->getItemFactoryMock($times));
        $result = $factory->build($feed);

        $this->assertEquals($expected, $result);
    }

    /**
     * @param int $times
     * @return \PHPUnit_Framework_MockObject_MockObject|EntityFactoryInterface
     */
    protected function getItemFactoryMock(int $times)
    {
        /** @var ItemFactory|\PHPUnit_Framework_MockObject_MockObject $factory */
        $factory = $this->createMock(ItemFactory::class);

        /** @var \PHPUnit_Framework_MockObject_Builder_InvocationMocker $expects */
        $expects = $factory->expects($this->exactly($times))->method('build');
        $expects->willReturn(new Item());

        return $factory;
    }
}
