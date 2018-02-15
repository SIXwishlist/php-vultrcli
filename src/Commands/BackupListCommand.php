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
use Vultr\Backup;

class BackupListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('backup:list')
            ->setDescription('Get a list of all backups on the current account.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $backup = (new Backup())->backup();
        $output->write($backup);
    }
}
