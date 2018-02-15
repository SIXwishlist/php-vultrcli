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
use Vultr\Decorators\FirewallRuleCreatePayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\Firewall;

class FirewallRuleCreateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('firewall:rule_create')
            ->setDescription('Create a rule in a firewall group.')
            ->addArgument('FIREWALLGROUPID', InputArgument::REQUIRED, 'string Target firewall group.')
            ->addArgument('direction', InputArgument::REQUIRED, 'string Direction of rule. Possible values: "in".')
            ->addArgument('ip_type', InputArgument::REQUIRED, 'string IP address type. Possible values: "v4", "v6".')
            ->addArgument('protocol', InputArgument::REQUIRED, 'string Protocol type. Possible values: "icmp", "tcp", "udp", "gre".')
            ->addArgument('subnet', InputArgument::REQUIRED, 'string IP address representing a subnet. The IP address format must match with the "ip_type" parameter value.')
            ->addArgument('subnet_size', InputArgument::REQUIRED, 'integer IP prefix size in bits.')
            ->addArgument('port', InputArgument::OPTIONAL, 'string (optional) TCP/UDP only. This field can be an integer value specifying a port or a colon separated port range.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('creating new firewall rule for group id : [group] - %s', $input->getArgument('FIREWALLGROUPID')));

        $command = (new Firewall())->rule_create((new FirewallRuleCreatePayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('New Firewall Rule added.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopps..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
