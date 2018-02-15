<?php

namespace Vultr;

use Psr\Http\Message\ResponseInterface;
use Vultr\HasApiKey;

class Server extends Api
{
    use HasApiKey;
    
    private $endpoint = [

        self::SERVER_LIST => self::SERVER_LIST,
        self::SERVER_START => self::SERVER_START,
        self::SERVER_REBOOT => self::SERVER_REBOOT,
        self::SERVER_CREATE => self::SERVER_CREATE,
    ];

    const SEGMENT = 'server/';

    const SERVER_LIST = 'list';
    const SERVER_START = 'start';
    const SERVER_REBOOT = 'reboot';
    const SERVER_CREATE = 'create';

    const SUB_ID_KEY = 'SUBID';

    public function servers(): ResponseInterface // experiment forcing using php7
    {
        return $this->http->request('GET',
            static::BASE_URL.static::SEGMENT.$this->endpoint[self::SERVER_LIST], [
            'headers' => $this->header()
        ]);
    }

    /**
     * @param array $data
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function create(array $data) : ResponseInterface
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::SERVER_CREATE], [
            'headers' => $this->header(),
            'form_params' => $data
        ]);
    }

    public function reboot($server)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::SERVER_REBOOT], [
            'headers' => $this->header(),
            'form_params' => [
                self::SUB_ID_KEY => $server
            ]
        ])->getBody()->getContents();
    }

    public function start($server)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::SERVER_START], [
            'headers' => $this->header(),
            'form_params' => [self::SUB_ID_KEY => $server]
        ])->getBody()->getContents();
    }
}
