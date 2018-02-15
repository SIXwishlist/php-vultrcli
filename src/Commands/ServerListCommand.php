<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Vultr\Server;

class ServerListCommand extends Command
{
    protected function configure()
    {
        $this->setName('server:list')
            ->setDescription('List all active or pending virtual machines on the current account.')
            ->setHelp('The "status" field represents the status of the subscription and will be one of: pending | active | suspended | closed. If the status is "active", you can check "power_status" to determine if the VPS is powered on or not. When status is "active", you may also use "server_state" for a more detailed status of: none | locked | installingbooting | isomounting | ok.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $servers = (new Server())->servers();

        $data = [];

        foreach (json_decode($servers->getBody()->getContents()) as $key => $value) {
            $data[] = [

                'SUBID' => $value->SUBID,
                'os' => $value->os,
                'ram' => $value->ram,
                'disk' => $value->disk,
                'location' => $value->location,
                'data_center' => $value->DCID
            ];
        }

        $rows = [];

        //naive ways to serialize to rows formats
        foreach ($data as $item) {
            foreach ($item as $key => $value) {
                $rows[] = $value;
            }
        }

        $table = new Table($output);
        $table
            ->setHeaders(array('SUBID', 'OS', 'RAM','DISK','LOCATION','DATA CENTER'))
            ->setRows(array(
                $rows
            ));

        $table->render();
    }
}
