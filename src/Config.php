<?php
namespace Vultr;

use Dotenv\Dotenv;

class Config
{
    private $config;

    public function __construct()
    {
        $this->config = new Dotenv(__DIR__, '.env');
        $this->config->load();
        $this->config->required('API_KEY')->notEmpty();
        $this->config->required('PROVIDER')->notEmpty();
    }

    public function getInstance()
    {
        return $this->config;
    }

    public function getProvider()
    {
        return mb_strtolower(getenv('PROVIDER'));
    }

    public function getApiKey()
    {
        return getenv('API_KEY');
    }
}
