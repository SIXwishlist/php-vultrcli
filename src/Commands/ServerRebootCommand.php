<?php
/**
 * Created by PhpStorm.
 * User: Tajul
 * Date: 6/5/2017
 * Time: 9:41 PM
 */

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Server;

class ServerRebootCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('server:reboot')
            ->setDescription('Reboot a virtual machine.')
            ->addArgument('server', InputArgument::REQUIRED, 'SUBID or known as server code ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $action = (new Server())->reboot($input->getArgument('server'));
        return $output->write($action);
    }
}
