<?php

namespace Vultr\Decorators;


class DnsCreateDomainPayloadTransformer extends BaseTransformer implements TransformerInterface
{

    const DOMAIN = 'domain';
    const SERVERIP = 'serverip';

    /**
     * preparing payload by transform into key value
     * @return array
     */
    public function prepare()
    {
        return [
            self::DOMAIN => $this->getOutputInterface()->getArgument('domain'),
            self::SERVERIP => $this->getOutputInterface()->getArgument('serverip')
        ];
    }

}
