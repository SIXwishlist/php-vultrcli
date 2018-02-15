<?php

namespace Vultr;

use Vultr\HasApiKey;

class Plans extends Api
{
    use HasApiKey;
    
    private $endpoint = [

        'list' => self::PLAN_LIST,
        'list_vc2' => self::PLAN_LIST_VC2,
        'list_vdc2' => self::PLAN_LIST_VDC2,

    ];

    const SEGMENT = 'plans/';

    const PLAN_LIST = 'list';
    const PLAN_LIST_VC2 = 'list_vc2';
    const PLAN_LIST_VDC2 = 'list_vdc2';

    public function plans($type)
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::PLAN_LIST], [
            'query' => [
                'type' => $type,
            ]
        ])->getBody()->getContents();
    }

    public function plans_vc2()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::PLAN_LIST_VC2])->getBody()->getContents();
    }

    public function plans_vdc2()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::PLAN_LIST_VDC2])->getBody()->getContents();
    }
}
