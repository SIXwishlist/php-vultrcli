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
use Vultr\Dns;

class DnsListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('dns:list')
            ->setDescription('Get a list all domains associated with the current account.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dns = (new Dns())->dns();
        $output->write($dns);
    }
}
