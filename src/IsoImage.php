<?php
namespace Vultr;

use Vultr\HasApiKey;

class IsoImage extends Api
{
    use HasApiKey;
    
    private $endpoint = [

        'list' => self::ISO_LIST,
        'create_from_url' => self::ISO_CREATE_FROM_URL,
    ];

    const SEGMENT = 'iso/';

    const ISO_LIST = 'list';
    const ISO_CREATE_FROM_URL = 'create_from_url';

    public function isos()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::ISO_LIST])->getBody()->getContents();
    }

    public function createFromUrl($url)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::ISO_CREATE_FROM_URL], [
            'query' => [
                'url' => $url,
            ]
        ])->getBody()->getContents();
    }
}
