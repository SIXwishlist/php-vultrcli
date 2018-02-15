<?php

namespace Vultr;

use Vultr\HasApiKey;

class Regions extends Api
{
    use HasApiKey;
    
    private $endpoint = [

        'list' => self::REGION_LIST,
        'availability' => self::REGION_AVAILABILITY,
        'availability_vc2' => self::REGION_AVAILABILITY_VC2,
        'availability_vdc2' => self::REGION_AVAILABILITY_VDC2,

    ];

    const SEGMENT = 'regions/';

    const REGION_LIST = 'list';
    const REGION_AVAILABILITY = 'availability';
    const REGION_AVAILABILITY_VC2 = 'availability_vc2';
    const REGION_AVAILABILITY_VDC2 = 'availability_vdc2';

    public function availability($DCID)
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::REGION_AVAILABILITY], [
            'query' => [
                'DCID' => $DCID,
            ]
        ])->getBody()->getContents();
    }

    public function availability_vc2($DCID)
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::REGION_AVAILABILITY_VC2], [
            'query' => [
                'DCID' => $DCID,
            ]
        ])->getBody()->getContents();
    }

    public function availability_vdc2($DCID)
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::REGION_AVAILABILITY_VDC2], [
            'query' => [
                'DCID' => $DCID,
            ]
        ])->getBody()->getContents();
    }

    public function regions()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::REGION_LIST])->getBody()->getContents();
    }
}
