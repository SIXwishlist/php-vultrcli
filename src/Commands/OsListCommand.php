<?php
/**
 * Created by PhpStorm.
 * User: Tajul
 * Date: 6/6/2017
 * Time: 6:06 AM
 */

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\OperatingSystem;

class OsListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('os:list')
            ->setDescription('Get a list of available operating systems.')
            ->setHelp('If the "windows" flag is true, a Windows license will be included with the instance, which will increase the cost.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $run = (new OperatingSystem())->oses();

        $tableData = [];

        foreach (json_decode($run) as $osData) {
            $tableData[] = [
                $osData->OSID,
                $osData->name,
                $osData->arch,
                $osData->family,
            ];
        }

        $table = new Table($output);

        $table
            ->setHeaders([
                'ID', 'Name', 'Architecture', 'Family',
            ])
            ->setRows($tableData)
            ->render();
    }
}
