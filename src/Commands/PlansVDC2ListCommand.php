<?php
/**
 * Created by PhpStorm.
 * User: Tajul
 * Date: 6/5/2017
 * Time: 10:04 PM
 */

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Plans;

class PlansVDC2ListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('plans:list_vdc2')
            ->setDescription('Get a list of all active vdc2 plans.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $plans = (new Plans())->plans_vdc2();
        $output->write($plans);
    }
}
