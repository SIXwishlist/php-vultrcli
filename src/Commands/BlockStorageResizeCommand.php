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
use Vultr\Decorators\BlockStorageResizePayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\BlockStorage;

class BlockStorageResizeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('block_storage:resize')
            ->setDescription('Resize the block storage volume to a new size.')
            ->setHelp('WARNING: When shrinking the volume, you must manually shrink the filesystem and partitions beforehand, or you will lose data.')
            ->addArgument('SUBID', InputArgument::REQUIRED, 'integer ID of the block storage subscription to resize')
            ->addArgument('size_gb', InputArgument::REQUIRED, 'integer New size (in GB) of the block storage subscription');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('resizing block storage : [SUBID] - %s', $input->getArgument('SUBID')));

        $block = (new BlockStorage())->resize((new BlockStorageResizePayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('Existing Block Storage resized.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopp..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
