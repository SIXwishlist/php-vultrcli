<?php

namespace Vultr\Decorators;

use Symfony\Component\Console\Input\InputInterface;

abstract class BaseTransformer
{
    private $input;

    public function __construct(InputInterface $input)
    {
        $this->input = $input;
    }

    public function getOutputInterface()
    {
        return $this->input;
    }
}