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
use Vultr\Decorators\BlockStorageDeletePayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\BlockStorage;

class BlockStorageDeleteCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('block_storage:delete')
            ->setDescription('Delete a block storage subscription. All data will be permanently lost.')
            ->addArgument('SUBID', InputArgument::REQUIRED, 'integer ID of the block storage subscription to delete')
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('deleting existing block storage : [SUBID] - %s', $input->getArgument('SUBID')));

        $block = (new BlockStorage())->_delete((new BlockStorageDeletePayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('Existing Block Storage deleted.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopp..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
