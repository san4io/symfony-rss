<?php

namespace RssBundle\Services;

use FeedIo\FeedInterface;
use FeedIo\FeedIo;
use RssBundle\Entity\Feed;
use RssBundle\Entity\Repository\FeedRepository;
use RssBundle\Services\Decorator\FeedDecorator;
use RssBundle\Services\Factory\EntityFactoryInterface;


/**
 * Class SaveHandler
 * @package RssBundle\Services
 */
class SaveHandler
{
    /**
     * @var FeedIo
     */
    protected $feedIo;

    /**
     * @var EntityFactoryInterface
     */
    protected $feedFactory;

    /**
     * @var FeedRepository
     */
    protected $feedRepository;

    /**
     * ParserService constructor.
     * @param FeedIo $feedIo
     * @param EntityFactoryInterface $feedFactory
     * @param FeedRepository $feedRepository
     */
    public function __construct(FeedIo $feedIo, EntityFactoryInterface $feedFactory, FeedRepository $feedRepository)
    {
        $this->feedIo = $feedIo;
        $this->feedFactory = $feedFactory;
        $this->feedRepository = $feedRepository;
    }

    /**
     * @param string $url
     * @param string $category
     */
    public function save(string $url, string $category)
    {
        $data = $this->getFeedData($url, $category);

        $feed = $this->buildFeed($data);

        $this->feedRepository->save($feed);
    }

    /**
     * @param string $url
     * @param string $category
     * @return FeedInterface
     */
    protected function getFeedData(string $url, string $category): FeedInterface
    {
        $feedData = $this->parseFeed($url);

        $feedData = (new FeedDecorator($feedData))->decorate(compact('url', 'category'));

        return $feedData;
    }

    /**
     * @param string $url
     * @return FeedInterface
     * @throws \Exception
     */
    protected function parseFeed(string $url): FeedInterface
    {
        try {
            $feed = $this->feedIo->read($url)->getFeed();
        } catch (\Exception $e) {
            throw new \Exception('Unable to get feed');
        }

        return $feed;
    }

    /**
     * @param FeedInterface $feedData
     * @return Feed
     */
    protected function buildFeed(FeedInterface $feedData): Feed
    {
        /** @var Feed $feed */
        $feed = $this->feedFactory->build($feedData);

        return $feed;
    }
}