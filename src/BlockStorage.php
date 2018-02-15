<?php
namespace Vultr;
use Vultr\HasApiKey;

class BlockStorage extends Api
{
    use HasApiKey;

    private $endpoint = [

        'list' => self::BLOCK_STORAGE_LIST,
        'attach' => self::BLOCK_STORAGE_ATTACH,
        'create' => self::BLOCK_STORAGE_CREATE,
        'delete' => self::BLOCK_STORAGE_DELETE,
        'detach' => self::BLOCK_STORAGE_DETACH,
        'label_set' => self::BLOCK_STORAGE_LABEL_SET,
        'resize' => self::BLOCK_STORAGE_RESIZE,

    ];

    const SEGMENT = 'block/';
    const BLOCK_STORAGE_LIST = 'list';
    const BLOCK_STORAGE_ATTACH = 'attach';
    const BLOCK_STORAGE_CREATE = 'create';
    const BLOCK_STORAGE_DELETE = 'delete';
    const BLOCK_STORAGE_DETACH = 'detach';
    const BLOCK_STORAGE_LABEL_SET = 'label_set';
    const BLOCK_STORAGE_RESIZE = 'resize';


    public function blockstorage()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::BLOCK_STORAGE_LIST], [
            'headers' => $this->header(),
        ])->getBody()->getContents();
    }

    public function attach(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::BLOCK_STORAGE_ATTACH], [
            'headers' => $this->header(),
                'form_params' => $data;
            ]);
    }

    public function create(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::BLOCK_STORAGE_CREATE], [
            'headers' => $this->header(),
                'form_params' => $data;
            ]);
    }

    public function _delete(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::BLOCK_STORAGE_DELETE], [
            'headers' => $this->header(),
                'form_params' => $data;
            ]);
    }

    public function detach(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::BLOCK_STORAGE_DETACH], [
            'headers' => $this->header(),
                'form_params' => $data;
            ]);
    }

    public function label_set(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::BLOCK_STORAGE_LABEL_SET], [
            'headers' => $this->header(),
                'form_params' => $data;
            ]);
    }

    public function resize(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::BLOCK_STORAGE_RESIZE], [
            'headers' => $this->header(),
                'form_params' => $data;
            ]);
    }
}
