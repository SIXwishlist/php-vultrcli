<?php
namespace Vultr\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Vultr\Account;

class AccountInfoCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('account:info')
            ->setDescription('Get information about the current account.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $account = Account::make()->setApiKey('TBHOK5BG6OHUVBQ662ZL6AE5ZLSSE6AWLXHQ')->account();

        return $output->write($account->getBody()->getContents());
    }
}
