<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;

use PHPUnit\Framework\TestCase;
use FieldNation\LoginCredentials;
use FieldNation\SDK;
use FieldNation\SoapClient;

class SoapClientTest extends TestCase
{
    protected $client;
    protected $phpSoapClient;

    public function setUp()
    {
//        $login = new LoginCredentials('foo', 'bar');
//        $sdk = new SDK($login);
//        $version = $sdk->getCurrentStableSoapVersion();
//        $this->phpSoapClient = $this->getMockFromWsdl(__DIR__ . '/../Fixtures/fieldnation.wsdl');
//        $this->client = new SoapClient($version, $this->phpSoapClient);
    }

    public function tearDown()
    {
//        unset($this->client);
    }

    public function testCanBeConstructedWithAVersionWithoutVPrefix()
    {
        $this->markTestSkipped('must be revisited.');
        $this->client = new SoapClient('3.15', $this->phpSoapClient);
        $this->assertInstanceOf(SoapClient::class, $this->client);
    }

    public function testCanBeConstructedWithVersionWithAVPrefix()
    {
        $this->markTestSkipped('must be revisited.');
        $this->client = new SoapClient('v3.15', $this->phpSoapClient);
        $this->assertInstanceOf(SoapClient::class, $this->client);
    }

    public function testWSDLIsGenerated()
    {
        $this->markTestSkipped('must be revisited.');
        $this->assertNotEmpty($this->client->getWSDL());
    }

    public function testDescribingClientReturnsArrayOfActions()
    {
        $this->markTestSkipped('must be revisited.');
        $this->phpSoapClient->method('__getFunctions')->willReturn(array('foo' => 'bar'));
        $this->assertTrue(is_array($this->client->describe()));
    }

    /**
     * @uses \SoapClient
     */
    public function testCanCreateItsOwnSoapClient()
    {
        $this->markTestSkipped('must be revisited.');
        $this->client = new SoapClient('3.15');
        $this->assertInstanceOf(SoapClient::class, $this->client);
    }
}
