<?php
namespace Vultr;

use Vultr\HasApiKey;

class OperatingSystem extends Api
{
	use HasApiKey;

    private $endpoint = [

        'list' => self::OS_LIST,
    ];

    const SEGMENT = 'os/';

    const OS_LIST = 'list';

    public function oses()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::OS_LIST])->getBody()->getContents();
    }
}
