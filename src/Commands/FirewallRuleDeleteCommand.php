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
use Vultr\Decorators\FirewallRuleDeletePayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\Firewall;

class FirewallRuleDeleteCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('firewall:rule_delete')
            ->setDescription('Delete a rule in a firewall group.')
            ->addArgument('FIREWALLGROUPID', InputArgument::REQUIRED, 'FIREWALLGROUPID string Target firewall group.')
            ->addArgument('rulenumber', InputArgument::REQUIRED, 'integer Rule number to delete.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('deleting firewall rule number : [rule] - %s', $input->getArgument('rulenumber')));

        $command = (new Firewall())->rule_delete((new FirewallRuleDeletePayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('Firewall Rule deleted.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopps..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
