<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Decorators\DnsCreateDomainPayloadTransformer;
use Vultr\HasExtrasMethods;

use Vultr\Dns;

class DnsCreateDomainCommand extends Command
{
    use HasExtrasMethods;

    protected function configure()
    {
        $this
            ->setName('dns:create_domain')
            ->setDescription('Create a domain name in DNS..')
            ->addArgument('domain', InputArgument::REQUIRED, 'string Domain name to create')
            ->addArgument('serverip', InputArgument::REQUIRED, 'string Server IP to use when creating default records (A and MX)');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('creating new domain name in DNS : [domain] - %s',$input->getArgument('domain')));

        $command = (new Dns())->create_domain((new DnsPayloadTransformer($input))->prepare());
        if($command->getStatusCode() == 201) {

            $output->writeln('New DNS record added.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else {

            $output->writeln('oopps...we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
