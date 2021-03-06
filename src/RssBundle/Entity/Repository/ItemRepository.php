<?php

namespace RssBundle\Entity\Repository;

use RssBundle\Entity\Item;

/**
 * ItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItemRepository extends AbstractEntityRepository
{
    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return Item::class;
    }
}
