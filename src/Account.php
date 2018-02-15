<?php
namespace Vultr;

use Psr\Http\Message\ResponseInterface;
use Vultr\HasApiKey;

class Account extends Api
{
    const SEGMENT = 'account/info';
    const API_KEY_INFO = 'auth/info';

    use HasExtrasMethods,HasApiKey;

    public function account(): ResponseInterface
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT, [
            'headers' => $this->header(),
        ]);
    }

    public function userInfo(): ResponseInterface
    {
        return $this->http->request('GET', static::BASE_URL.static::API_KEY_INFO, [
            'headers' => $this->header(),
        ]);
    }
}
