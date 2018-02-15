<?php
namespace Vultr;

trait HasExtrasMethods
{
    public function __toString()
    {
        return json_encode($this);
    }

    public function toJson($array) : string {

        return json_encode($array);
    }
}
