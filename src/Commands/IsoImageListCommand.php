<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\IsoImage;

class IsoImageListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('iso:list')
            ->setDescription('Get all ISOs currently available on this account.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $iso = (new IsoImage())->isos();
        $output->write($iso);
    }
}
