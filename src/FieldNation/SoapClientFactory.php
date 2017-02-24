<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class SoapClientFactory implements ClientFactoryInterface
{

    /**
     * Get a client to fulfil requests
     *
     * @return ClientInterface
     */
    public function getClient($version=NULL)
    {
        $version = $version || SoapClient::STABLE_SOAP_VERSION;
        return new SoapClient($version);
    }
}