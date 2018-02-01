<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.9.29
 * Time: 19.35
 */

namespace RssBundle\Services\Decorator;

use FeedIo\FeedInterface;

/**
 * Class FeedDecorator
 * @package RssBundle\Services\Decorator
 */
class FeedDecorator
{
    /**
     * @var FeedInterface
     */
    protected $feed;

    /**
     * FeedDecorator constructor.
     * @param FeedInterface $feed
     */
    public function __construct(FeedInterface $feed)
    {
        $this->feed = $feed;
    }

    /**
     * @param array $params
     * @return FeedInterface
     */
    public function decorate(array $params = []): FeedInterface
    {
        foreach ($params as $name => $value) {
            $this->feed->set($name, $value);
        }

        return $this->feed;
    }
}