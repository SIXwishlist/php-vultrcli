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
use Vultr\Decorators\BlockStorageDetachPayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\BlockStorage;

class BlockStorageDetachCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('block_storage:detach')
            ->setDescription('Detach a block storage subscription from the currently attached instance.')
            ->addArgument('SUBID', InputArgument::REQUIRED, 'integer ID of the block storage subscription to detach')
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('detaching existing block storage : [SUBID] - %s', $input->getArgument('SUBID')));

        $block = (new BlockStorage())->detach((new BlockStorageDetachPayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('Existing Block Storage detached.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopp..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
