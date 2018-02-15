<?php
namespace Vultr\Decorators;


interface TransformerInterface
{
    /**
     * contract prepare method
     * @return mixed
     */
    public function prepare();
}