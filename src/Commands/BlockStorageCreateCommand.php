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
use Vultr\Decorators\BlockStorageCreatePayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\BlockStorage;

class BlockStorageCreateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('block_storage:create')
            ->setDescription('Create a block storage subscription.')
            ->addArgument('DCID', InputArgument::REQUIRED, 'integer DCID of the location to create this subscription in.')
            ->addArgument('size_gb', InputArgument::REQUIRED, 'integer Size (in GB) of this subscription.')
            ->addArgument('label', InputArgument::OPTIONAL, 'string (optional) Text label that will be associated with the subscription');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('creating new block storage : [DCID] - %s', $input->getArgument('DCID')));

        $block = (new BlockStorage())->create((new BlockStorageCreatePayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('New Block Storage created.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopp..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
