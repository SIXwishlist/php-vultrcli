<?php

namespace Vultr;

use Vultr\HasApiKey;

class Snapshot extends Api
{
    use HasApiKey;
    
    private $endpoint = [

        'list' => self::SNAPSHOT_LIST,
        'create' => self::SNAPSHOT_CREATE,
        'destroy' => self::SNAPSHOT_DESTROY,
    ];

    const SEGMENT = 'snapshot/';

    const SNAPSHOT_LIST = 'list';
    const SNAPSHOT_CREATE = 'create';
    const SNAPSHOT_DESTROY = 'destroy';

    public function snapshots()
    {
        return $this->http->request('GET',static::BASE_URL.static::SEGMENT.$this->endpoint[self::SNAPSHOT_LIST], ['headers' => $this->header()])->getBody()->getContents();
    }

    public function create($SUBID)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::SNAPSHOT_CREATE], ['headers' => $this->header(),
            'body' => $SUBID
        ])->getBody()->getContents();
    }

    public function destroy($SNAPSHOTID)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::SNAPSHOT_REBOOT], ['headers' => $this->header(),
            'body' => $SNAPSHOTID
        ])->getBody()->getContents();
    }
}
