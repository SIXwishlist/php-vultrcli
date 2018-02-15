<?php
/**
 * Created by PhpStorm.
 * User: Tajul
 * Date: 6/6/2017
 * Time: 2:27 AM
 */

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Firewall;

class FirewallGroupListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('firewall:group_list')
            ->setDescription('Get a list all firewall groups on the current account.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $firewall = (new Firewall())->group_list();
        $output->write($firewall);
    }
}
