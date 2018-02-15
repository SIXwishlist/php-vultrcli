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
use Vultr\Decorators\FirewallGroupCreatePayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\Firewall;

class FirewallGroupCreateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('firewall:group_create')
            ->setDescription('Create a new firewall group on the current account.')
            ->addArgument('description', InputArgument::REQUIRED, 'description string (optional) Description of firewall group.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('creating new firewall group : [group] - %s', $input->getArgument('description')));

        $command = (new Firewall())->group_create((new FirewallGroupCreatePayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('New Firewall Group added.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopps..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
