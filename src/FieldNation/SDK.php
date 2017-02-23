<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class SDK implements SDKInterface
{
    const CURRENT_STABLE_SOAP_VERSION = '3.15';
    private $version;
    private $login;

    /**
     * FieldNation\SDK constructor.
     * Access the Field Nation SDK, defaulting to CURRENT_STABLE_SOAP_VERSION
     * @param string $version
     */
    public function __construct(LoginCredentialsInterface $login, $version=self::CURRENT_STABLE_SOAP_VERSION)
    {
        $this->login = $login;
        $this->version = $version;
    }

    /**
     * Get the current stable version of the Field Nation SOAP API
     * @return string
     */
    public function getCurrentStableSoapVersion()
    {
        return self::CURRENT_STABLE_SOAP_VERSION;
    }

    /**
     * Get the possible versions to target
     * @return string[]
     */
    public function getVersions()
    {
        return array(
            '3.11',
            '3.12',
            '3.13',
            '3.14',
            '3.15'
        );
    }

    /**
     * Get the SOAP version the SDK is targeting
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the SOAP version to target
     * @param $value
     * @return $this
     */
    public function setVersion($value)
    {
        $this->version = $value;
        return $this;
    }
}