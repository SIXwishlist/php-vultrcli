<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Plans;

class PlansListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('plans:list')
            ->setDescription('Get all available instances plans. Possible values: "all", "vc2", "ssd", "vdc2", "dedicated".')
            ->addArgument('type', InputArgument::REQUIRED, 'instances type integer');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $plans = (new Plans())->plans($input->getArgument('type'));

        $table = new Table($output);
        $tableData = [];

        foreach (json_decode($plans) as $plan) {

            $tableData[] = [
                $plan->VPSPLANID,
                $plan->name,
                $plan->vcpu_count,
                $plan->ram,
                $plan->disk,
                $plan->bandwidth,
                $plan->price_per_month,
            ];
        }

        $table
            ->setHeaders([
                'PLAN ID', 'Name', 'Cpu count', 'RAM', 'Disk Size', 'Bandwidth', 'Price (USD)',
            ])
            ->setRows($tableData)
            ->render();
    }
}
