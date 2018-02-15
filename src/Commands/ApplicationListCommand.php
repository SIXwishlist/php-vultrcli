<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Applications;

class ApplicationListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:list')
            ->setDescription('Get a list of available applications.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $application = (new Applications())->applications();
        $output->write($application);
    }
}
