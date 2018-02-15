<?php
namespace Vultr;
use Vultr\HasApiKey;

class ReservedIp extends Api
{
    use HasApiKey;

    private $endpoint = [

        'list' => self::RESERVED_IP_LIST,
        'attach' => self::RESERVED_IP_ATTACH,
        'convert' => self::RESERVED_IP_CONVERT,
        'create' => self::RESERVED_IP_CREATE,
        'destroy' => self::RESERVED_IP_DESTROY,
        'detach' => self::RESERVED_IP_DETACH,

    ];

    const SEGMENT = 'reservedip/';
    const RESERVED_IP_LIST = 'list';
    const RESERVED_IP_ATTACH = 'attach';
    const RESERVED_IP_CONVERT = 'convert';
    const RESERVED_IP_CREATE = 'create';
    const RESERVED_IP_DESTROY = 'destroy';
    const RESERVED_IP_DETACH = 'detach';


    public function reservedip()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::RESERVED_IP_LIST], [
            'headers' => $this->header(),
        ])->getBody()->getContents();
    }

    public function attach(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::RESERVED_IP_ATTACH], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function convert(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::RESERVED_IP_CONVERT], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function create(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::RESERVED_IP_CREATE], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function destroy(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::RESERVED_IP_destroy], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function detach(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::RESERVED_IP_DETACH], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }
}
