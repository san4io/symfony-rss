<?php

namespace RssBundle\Controller;

use RssBundle\Entity\Feed;
use RssBundle\Entity\Repository\FeedRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package RssBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(): Response
    {
        $repository = $this->getFeedRepository();

        $feeds = $repository->findBy([], ['id' => 'desc']);

        return $this->render('RssBundle:Rss:index.html.twig', compact('feeds'));
    }

    /**
     * @param string $category
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/category/{category}", name="show_category")
     */
    public function showCategoryAction(string $category): Response
    {
        $repository = $this->getFeedRepository();

        $feeds = $repository->findBy(compact('category'), ['id' => 'desc']);

        return $this->render('RssBundle:Rss:category.html.twig', compact('feeds'));
    }

    /**
     * @param Feed $feed
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/{id}", name="show")
     * @ParamConverter("feed")
     */
    public function showAction(Feed $feed): Response
    {
        return $this->render('RssBundle:Rss:show.html.twig', compact('feed'));
    }

    /**
     * @return FeedRepository
     */
    private function getFeedRepository(): FeedRepository
    {
        /** @var FeedRepository $repository */
        $repository = $this->get('rss.entity.repository.feed');

        return $repository;
    }
}
