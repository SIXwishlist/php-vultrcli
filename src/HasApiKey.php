<?php
namespace Vultr;

use Exception;

trait HasApiKey
{

   	protected $key;

   	public static function make()
    {
        return new static;
    }

    public function setApiKey($key)
    {
 		$this->key = $key;
 		return $this;
    }

    public function getApiKey()
    {
        return $this->key;
    }
}
