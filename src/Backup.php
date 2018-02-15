<?php
namespace Vultr;
use Vultr\HasApiKey;

class Backup extends Api
{
    use HasApiKey;
    
    private $endpoint = [

        'list' => self::BACKUP_LIST,

    ];

    const SEGMENT = 'backup/';
    const BACKUP_LIST = 'list';


    public function backup()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::BACKUP_LIST], [
            'headers' => $this->header(),
        ])->getBody()->getContents();
    }
}
