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
use Vultr\Decorators\FirewallGroupDeletePayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\Firewall;

class FirewallGroupDeleteCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('firewall:group_delete')
            ->setDescription('Delete a firewall group.')
            ->setHelp('Use this function with caution because the firewall group being deleted will be detached from all servers. This can result in open ports accessible to the internet.')
            ->addArgument('FIREWALLGROUPID', InputArgument::REQUIRED, 'FIREWALLGROUPID string Firewall group to delete.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('deleting firewall group : [group] - %s', $input->getArgument('FIREWALLGROUPID')));

        $command = (new Firewall())->group_delete((new FirewallGroupDeletePayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('Firewall Group deleted.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopps..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
