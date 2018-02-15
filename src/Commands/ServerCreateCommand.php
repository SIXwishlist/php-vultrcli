<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Decorators\ServerPayloadTransformer;
use Vultr\HasExtrasMethods;

use Vultr\Server;

class ServerCreateCommand extends Command
{
    use HasExtrasMethods;

    protected function configure()
    {
        $this
            ->setName('server:create')
            ->setDescription('Create a new virtual machine.')
            ->setHelp('You will start being billed for this immediately. The response only contains the SUBID for the new machine.')
            ->addArgument('datacenter', InputArgument::REQUIRED, 'Data center ID')
            ->addArgument('vpsplan', InputArgument::REQUIRED, 'Vps plan ID')
            ->addArgument('os', InputArgument::REQUIRED, 'Os ID');  
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        # TODO: implement nice progress bar here.?
        $output->writeln(sprintf('creating server : [data center] - %s',$input->getArgument('datacenter')));

        //passing payload preparation task to decorator layer.
        //anything changes related to providers API payload provisions we dont ever want to touch this command class again.
        //use Decorators layers instead for extension and modification.
        $command = (new Server())->create((new ServerPayloadTransformer($input))->prepare());
        if($command->getStatusCode() == 201) {

            $output->writeln('Server are created.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else {

            $output->writeln('oopps...we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
