<?php

namespace Vultr\Decorators;


class ServerPayloadTransformer extends BaseTransformer implements TransformerInterface
{

    /**
     * data center key const
     */
    const DCID = 'DCID';

    /**
     * Vps plan id key const
     */
    const VPSPLANID = 'VPSPLANID';

    /**
     * os id key const
     */
    const OSID = 'OSID';


    /**
     * preparing payload by transform into key value
     * @return array
     */
    public function prepare()
    {
        return [

            self::DCID => $this->getOutputInterface()->getArgument('datacenter'),
            self::VPSPLANID => $this->getOutputInterface()->getArgument('vpsplan'),
            self::OSID => $this->getOutputInterface()->getArgument('os')
        ];
    }

}