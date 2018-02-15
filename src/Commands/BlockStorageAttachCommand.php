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
use Vultr\Decorators\BlockStorageAttachPayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\BlockStorage;

class BlockStorageAttachCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('block_storage:attach')
            ->setDescription('Attach a block storage subscription to a VPS subscription.')
            ->setHelp('The block storage volume must not be attached to any other VPS subscriptions for this to work.')
            ->addArgument('SUBID', InputArgument::REQUIRED, 'integer ID of the block storage subscription to attach')
            ->addArgument('attach_to_SUBID', InputArgument::REQUIRED, 'integer ID of the VPS subscription to mount the block storage subscription to');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('attaching new block storage : [SUBID] - %s', $input->getArgument('SUBID')));

        $block = (new BlockStorage())->attach((new BlockStorageAttachPayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('New Block Storage attached.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopp..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
