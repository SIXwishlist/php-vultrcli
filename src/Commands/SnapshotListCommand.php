<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Vultr\Snapshot;

class SnapshotListCommand extends Command
{
    protected function configure()
    {
        $this->setName('snapshot:list')
            ->setDescription('Get a list all snapshots on the current account.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $snapshots = (new Snapshot())->snapshots();
        $output->write($snapshots);
    }
}
