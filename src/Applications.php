<?php
namespace Vultr;
use Vultr\HasApiKey;

class Applications extends Api
{
    const SEGMENT = 'app/list';

    use HasExtrasMethods,HasApiKey;

    public function applications()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT, [
            'headers' => $this->header(),
        ])->getBody()->getContents();
    }
}
