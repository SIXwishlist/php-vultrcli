<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Vultr\Snapshot;

class SnapshotDestroyCommand extends Command
{
    protected function configure()
    {
        $this->setName('snapshot:destroy')
            ->setDescription('Destroy (delete) a snapshot.')
            ->addArgument('SNAPSHOTID', InputArgument::REQUIRED, 'SNAPSHOTID type string');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $snapshots = (new Snapshot())->destroy($input->getArgument('SNAPSHOTID'));
        $output->write($snapshots);
    }
}
