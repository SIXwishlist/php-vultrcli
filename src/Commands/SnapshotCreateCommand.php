<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Vultr\Snapshot;

class SnapshotCreateCommand extends Command
{
    protected function configure()
    {
        $this->setName('snapshot:create')
            ->setDescription('Create a snapshot from an existing virtual machine. ')
            ->addArgument('SUBID', InputArgument::REQUIRED, 'SUBID type integer');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $snapshots = (new Snapshot())->create($input->getArgument('SUBID'));
        $output->write($snapshots);
    }
}
