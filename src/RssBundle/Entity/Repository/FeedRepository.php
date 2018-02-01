<?php

namespace RssBundle\Entity\Repository;

use RssBundle\Entity\Feed;

/**
 * FeedRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FeedRepository extends AbstractEntityRepository
{
    /**
     * @return string
     */
    public function getEntityClass(): string
    {
        return Feed::class;
    }
}