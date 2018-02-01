<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.9.29
 * Time: 07.43
 */

namespace RssBundle\Services\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use FeedIo\Feed\Item;
use FeedIo\FeedInterface;
use RssBundle\Entity\Feed;

/**
 * Class FeedFactory
 * @package RssBundle\Services\Factory
 */
class FeedFactory implements EntityFactoryInterface
{
    /**
     * @var ItemFactory
     */
    protected $itemFactory;

    /**
     * FeedFactory constructor.
     * @param EntityFactoryInterface $itemFactory
     */
    public function __construct(EntityFactoryInterface $itemFactory)
    {
        $this->itemFactory = $itemFactory;
    }

    /**
     * @param FeedInterface $data
     * @return Feed
     */
    public function build($data): Feed
    {
        $feed = new Feed();

        $feed->setUrl($data->getValue('url'));
        $feed->setTitle($data->getTitle());
        $feed->setLastUpdate($data->getLastModified());
        $feed->setCategory($data->getValue('category'));

        $feed->setItems(
            $this->buildItems($data)
        );

        return $feed;
    }

    /**
     * @param FeedInterface $data
     * @return ArrayCollection
     */
    protected function buildItems($data): ArrayCollection
    {
        $collection = new ArrayCollection();

        /** @var Item $item */
        foreach ($data as $item) {
            $collection->add(
                $this->itemFactory->build($item)
            );
        }

        return $collection;
    }
}