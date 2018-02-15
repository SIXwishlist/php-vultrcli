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
use Vultr\Regions;

class RegionsListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('regions:list')
            ->setDescription('Get a list of all active regions.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $regions = (new Regions())->regions();
        $output->write($regions);
    }
}
