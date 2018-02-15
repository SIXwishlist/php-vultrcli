<?php

namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Account;

class ApiAuthenticateUserCommand extends Command
{
    protected function configure()
    {
        $this
           ->setName('account:authenticate_user')
           ->setDescription('Get authenticated user by current api key info.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $info = (new Account())->userInfo();
        $output->write($info->getBody()->getContents());
    }
}
