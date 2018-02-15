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
use Vultr\BlockStorage;

class BlockStorageListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('block_storage:list')
            ->setDescription('Get a list of any active block storage subscriptions on this account.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $block = (new BlockStorage())->blockstorage();
        $output->write($block);
    }
}
