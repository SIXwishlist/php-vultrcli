<?php
namespace Vultr;

use Vultr\HasApiKey;
class Dns extends Api
{
    use HasApiKey;

    private $endpoint = [

        'list' => self::DNS_LIST,
        'records' => self::DNS_RECORDS,
        'create_domain' => self::DNS_CREATE_DOMAIN,
        'create_record' => self::DNS_CREATE_RECORD,
        'delete_domain' => self::DNS_DELETE_DOMAIN,
        'delete_record' => self::DNS_DELETE_RECORD,
        'update_record' => self::DNS_UPDATE_RECORD,

    ];

    const SEGMENT = 'dns/';

    const DNS_LIST = 'list';
    const DNS_RECORDS = 'records';
    const DNS_CREATE_DOMAIN = 'create_domain';
    const DNS_CREATE_RECORD = 'create_record';
    const DNS_DELETE_DOMAIN = 'delete_domain';
    const DNS_DELETE_RECORD = 'delete_record';
    const DNS_UPDATE_RECORD = 'update_record';

    public function dns()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::DNS_LIST], ['headers' => $this->header()])->getBody()->getContents();
    }

    public function records($domain)
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::DNS_RECORDS], ['headers' => $this->header()], [
            'query' => [
                'domain' => $domain,
            ]
        ])->getBody()->getContents();
    }

    public function create_domain(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::DNS_CREATE_DOMAIN], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function create_record(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::DNS_CREATE_RECORD], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function delete_domain(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::DNS_DELETE_RECORD], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function delete_record(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::DNS_DELETE_RECORD], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function update_record(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::DNS_UPDATE_RECORD], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }
}
