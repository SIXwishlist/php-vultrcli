<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Regions;

class RegionsAvailabilityCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('regions:availability')
            ->setDescription('Get a list of the VPSPLANIDs currently available in this location.')
            ->addArgument('DCID', InputArgument::REQUIRED, 'location DCID integer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $regions = (new Regions())->availability($input->getArgument('DCID'));
        $output->write($regions);
    }
}
