<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Plans;

class PlansListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('plans:list')
            ->setDescription('Get all available instances plans. Possible values: "all", "vc2", "ssd", "vdc2", "dedicated".')
            ->addArgument('type', InputArgument::REQUIRED, 'instances type integer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $plans = (new Plans())->servers($input->getArgument('type'));
        $output->write($plans);
    }
}
