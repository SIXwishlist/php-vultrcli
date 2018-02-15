<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\IsoImage;

class IsoImageCreateFromUrlCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('iso:create_from_url')
            ->setDescription('Create a new ISO image on the current account.')
            ->addArgument('url', InputArgument::REQUIRED, 'url string');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $iso = (new IsoImage())->createFromUrl($input->getArgument('url'));
        $output->write($iso);
    }
}
