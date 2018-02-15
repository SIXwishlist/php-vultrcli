<?php

namespace Vultr;

use GuzzleHttp\Client;

class Api
{
    protected $config;

    protected $http;

    const BASE_URL = 'https://api.vultr.com/v1/';

    const API_KEY_PARAM = 'API-Key';

    public function __construct()
    {
        $this->http = new Client;
    }

    public function header()
    {
        return [static::API_KEY_PARAM => $this->getApiKey()];
    }

}
