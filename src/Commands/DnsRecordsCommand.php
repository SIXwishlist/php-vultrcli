<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Dns;

class DnsRecordsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('dns:records')
            ->setDescription('Get all the records associated with a particular domain.')
            ->addArgument('domain', InputArgument::REQUIRED, 'domain name string');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dns = (new Dns())->records($input->getArgument('domain'));
        $output->write($dns);
    }
}
