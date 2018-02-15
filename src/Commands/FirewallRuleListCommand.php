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
use Vultr\Firewall;

class FirewallRuleListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('firewall:rule_list')
            ->setDescription('Get a list the rules in a firewall group.')
            ->addArgument('FIREWALLGROUPID', InputArgument::REQUIRED, 'string Target firewall group.')
            ->addArgument('direction', InputArgument::REQUIRED, 'string Direction of firewall rules.')
            ->addArgument('ip_type', InputArgument::REQUIRED, 'string IP address type.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $firewall = (new Firewall())->rule_list($input->getArgument('FIREWALLGROUPID'), $input->getArgument('direction'), $input->getArgument('ip_type'));
        $output->write($firewall);
    }
}
