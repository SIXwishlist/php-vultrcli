<?php
namespace Vultr;
use Vultr\HasApiKey;

class Firewall extends Api
{
    use HasApiKey;

    private $endpoint = [

        'list' => self::LIST_KEY,

    ];

    const SEGMENT = 'firewall/';
    const FIREWALL_GROUP_CREATE = 'group_create';
    const FIREWALL_GROUP_DELETE = 'group_delete';
    const FIREWALL_GROUP_LIST = 'group_list';
    const FIREWALL_RULE_CREATE = 'rule_create';
    const FIREWALL_RULE_DELETE = 'rule_delete';
    const FIREWALL_RULE_LIST = 'rule_list';


    public function group_list()
    {
        return $this->http->request('GET', static::BASE_URL.static::SEGMENT.$this->endpoint[self::FIREWALL_GROUP_LIST], [
            'headers' => $this->header(),
        ])->getBody()->getContents();
    }

    public function group_create(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::FIREWALL_GROUP_CREATE], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function group_delete(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::FIREWALL_GROUP_DELETE], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function rule_create(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::FIREWALL_RULE_CREATE], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function rule_delete(array $data)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::FIREWALL_RULE_DELETE], [
            'headers' => $this->header(),
                'form_params' => $data
            ]);
    }

    public function rule_list($FIREWALLGROUPID, $direction, $ip_type)
    {
        return $this->http->request('POST', static::BASE_URL.static::SEGMENT.$this->endpoint[self::FIREWALL_GROUP_CREATE], [
            'headers' => $this->header(),
                'query' => [
                    'FIREWALLGROUPID' => $FIREWALLGROUPID,
                    'direction' => $direction,
                    'ip_type' => $ip_type,
                ]
            ])->getBody()->getContents();
    }
}
