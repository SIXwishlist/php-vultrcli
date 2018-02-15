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
use Vultr\Decorators\BlockStorageLabelSetPayloadTransformer;
use Vultr\HasExtrasMethods;
use Vultr\BlockStorage;

class BlockStorageLabelSetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('block_storage:label_set')
            ->setDescription('Set the label of a block storage subscription.')
            ->addArgument('SUBID', InputArgument::REQUIRED, 'integer ID of the block storage subscription.')
            ->addArgument('label', InputArgument::REQUIRED, 'string Text label that will be shown in the control panel.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('labelling existing block storage : [SUBID] - %s', $input->getArgument('SUBID')));

        $block = (new BlockStorage())->label_set((new BlockStorageLabelSetPayloadTransformer($input))->prepare());

        if ($command->getStatusCode() == 201)
        {
            $output->writeln('Existing Block Storage labeled.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
        else
        {
            $output->writeln('oopp..we expected return some error.');
            $output->write($this->toJson($command->getBody()->getContents()));
        }
    }
}
