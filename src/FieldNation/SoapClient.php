<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

use \SoapClient as PHPSoapClient;

class SoapClient
{
    const SOAP_API_BASE = 'https://api.fieldnation.com/api/';
    const WSDL_NAME = '/fieldnation.wsdl';
    private $wsdl;
    private $soapClient;

    public function __construct($version, PHPSoapClient $client=NULL)
    {
        $this->setWSDL($version)
             ->setSoapClient($client);
    }

    /**
     * Initialize the SoapClient
     * @param SoapClient|Null $client
     * @return $this
     */
    private function setSoapClient($client=NULL)
    {
        if ($client) {
            $this->soapClient = $client;
        } else {
            $this->soapClient = new PHPSoapClient($this->getWSDL());
        }
        return $this;
    }

    /**
     * Set the wsdl URI string based on the $version
     * @param $version string
     * @return $this
     */
    private function setWSDL($version)
    {
        // The FN api has a v prefix on the version
        if (!ctype_alpha($version[0]))
            $version = 'v'.$version;
        $this->wsdl = self::SOAP_API_BASE . $version . self::WSDL_NAME;
        return $this;
    }

    /**
     * Get the WSDL URI
     * @return string
     */
    public function getWSDL()
    {
        return $this->wsdl;
    }

    /**
     * Describe the Field Nation SOAP Client by returning an array of actions
     * @return array
     */
    public function describe()
    {
        return $this->soapClient->__getFunctions();
    }
}