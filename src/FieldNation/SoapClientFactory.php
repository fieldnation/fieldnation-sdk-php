<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class SoapClientFactory implements ClientFactoryInterface
{
    private $credentials;
    private $version;

    public function __construct(SDKCredentialsInterface $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Get a client to fulfil requests
     *
     * @return ClientInterface
     */
    public function getClient($version = null)
    {
        $version = $version || $this->getClientVersion();
        return new SoapClient($this->credentials, $version);
    }

    /**
     * Set the version of the client
     *
     * @param $version
     * @return self
     */
    public function setClientVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Get the version of the client
     *
     * @return string
     */
    public function getClientVersion()
    {
        return $this->version ?: SoapClient::STABLE_SOAP_VERSION;
    }
}
