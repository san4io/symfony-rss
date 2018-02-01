<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.9.29
 * Time: 19.04
 */

namespace RssBundle\Services\Factory;

/**
 * Interface EntityFactoryInterface
 * @package RssBundle\Services\Factory
 */
interface EntityFactoryInterface
{
    /**
     * @param mixed $data
     * @return object
     */
    public function build($data);
}