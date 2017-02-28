<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;

use PHPUnit\Framework\TestCase;
use FieldNation\SDK;
use FieldNation\LoginCredentials;

class FieldNationSDKTest extends TestCase
{
    private $sdk;
    private $login;

    public function setUp()
    {
//        $this->login = new LoginCredentials('foo', 'bar');
//        $this->sdk = new SDK($this->login);
    }

    public function testCanBeCreatedWithNoVersionDefined()
    {
        $this->markTestSkipped('must be revisited.');
        $this->assertInstanceOf(SDK::class, $this->sdk);
        $this->assertEquals($this->sdk->getCurrentStableSoapVersion(), $this->sdk->getVersion());
    }

    public function testCanBeCreatedWithAVersionDefined()
    {
        $this->markTestSkipped('must be revisited.');
        $this->sdk = new SDK($this->login, '3.11');
        $this->assertInstanceOf(SDK::class, $this->sdk);
        $this->assertEquals('3.11', $this->sdk->getVersion());
    }

    public function testVersionCanBeSet()
    {
        $this->markTestSkipped('must be revisited.');
        $this->assertEquals($this->sdk->getCurrentStableSoapVersion(), $this->sdk->getVersion());
        $this->sdk->setVersion('3.11');
        $this->assertEquals('3.11', $this->sdk->getVersion());
    }

    public function testVersionsCanBeRead()
    {
        $this->markTestSkipped('must be revisited.');
        $this->assertContains($this->sdk->getCurrentStableSoapVersion(), $this->sdk->getVersions());
    }
}
