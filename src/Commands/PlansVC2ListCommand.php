<?php
namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Plans;

class PlansVC2ListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('plans:list_vc2')
            ->setDescription('Get a list of all active vc2 plans.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $plans = (new Plans())->plans_vc2();
        $output->write($plans);
    }
}
