<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.9.29
 * Time: 07.43
 */

namespace RssBundle\Services\Factory;

use RssBundle\Entity\Item;

/**
 * Class ItemFactory
 * @package RssBundle\Services\Factory
 */
class ItemFactory implements EntityFactoryInterface
{
    /**
     * @param \FeedIo\Feed\Item $data
     * @return Item
     */
    public function build($data): Item
    {
        $item = new Item();

        $item->setTitle($data->getTitle());
        $item->setDescription($data->getDescription());
        $item->setLink($data->getLink());
        $item->setPublished($data->getLastModified());

        return $item;
    }
}