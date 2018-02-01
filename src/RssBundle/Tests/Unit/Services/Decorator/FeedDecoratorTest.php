<?php

namespace RssBundle\Tests\Unit\Services\Factory;

use FeedIo\Feed;
use PHPUnit\Framework\TestCase;
use RssBundle\Services\Decorator\FeedDecorator;

/**
 * Class FeedDecoratorTest
 * @package RssBundle\Tests\Unit\Services\Factory
 */
class FeedDecoratorTest extends TestCase
{
    /**
     * @return array
     */
    public function dataProvider()
    {
        $cases = [];

        // Case 0: Nothing changed
        $result = new Feed();
        $cases[] = [new Feed(), [], $result];

        // Case 1: Adding Elements
        $result = new Feed();
        $result->set('url', 'url');
        $result->set('category', 'category');

        $cases[] = [new Feed(), ['url' => 'url', 'category' => 'category'], $result];
        return $cases;
    }

    /**
     * @param Feed $feed
     * @param array $params
     * @param Feed $expected
     *
     * @dataProvider dataProvider
     */
    public function testDecorator(Feed $feed, array $params, Feed $expected)
    {
        $decorator = new FeedDecorator($feed);
        $result = $decorator->decorate($params);

        $this->assertEquals($expected, $result);
    }
}
