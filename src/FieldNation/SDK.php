<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class SDK
{
    private static $CURRENT_STABLE_SOAP_VERSION = '3.15';
    protected $version;

    /**
     * FieldNation\SDK constructor.
     * Access the Field Nation SDK, defaulting to CURRENT_STABLE_SOAP_VERSION
     * @param string $version
     */
    public function __construct($version='')
    {
        $this->version = empty($version)
            ? self::$CURRENT_STABLE_SOAP_VERSION
            : $version;
    }

    /**
     * Get the current stable version of the Field Nation SOAP API
     * @return string
     */
    public function getCurrentStableSoapVersion()
    {
        return self::$CURRENT_STABLE_SOAP_VERSION;
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