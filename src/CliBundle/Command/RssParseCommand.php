<?php

namespace CliBundle\Command;

use RssBundle\Services\SaveHandler;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RssParseCommand
 * @package CliBundle\Command
 */
class RssParseCommand extends ContainerAwareCommand
{
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('rss:parse')
            ->setDescription('Parse RSS Feeds')
            ->addArgument('url', InputArgument::REQUIRED, 'Url from there to parse RSS feeds')
            ->addArgument('category', InputArgument::REQUIRED, 'Category of Rss');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $category = $input->getArgument('category');

        /** @var SaveHandler $saveHandler */
        $saveHandler = $this->getContainer()->get('rss.services.save_handler');
        $saveHandler->save($url, $category);

        $output->writeln('Success');
    }

}
