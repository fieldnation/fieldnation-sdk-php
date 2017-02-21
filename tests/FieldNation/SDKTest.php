<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;


use PHPUnit\Framework\TestCase;
use FieldNation\SDK;


class FieldNationSDKTest extends TestCase
{
    private $sdk;

    public function setUp()
    {
        $this->sdk = new SDK();
    }

    public function testCanBeCreatedWithNoVersionDefined()
    {
        $this->assertInstanceOf(SDK::class, $this->sdk);
        $this->assertEquals($this->sdk->getCurrentStableSoapVersion(), $this->sdk->getVersion());
    }

    public function testCanBeCreatedWithAVersionDefined()
    {
        $this->sdk = new SDK('3.11');
        $this->assertInstanceOf(SDK::class, $this->sdk);
        $this->assertEquals('3.11', $this->sdk->getVersion());
    }

    public function testVersionCanBeSet()
    {
        $this->assertEquals($this->sdk->getCurrentStableSoapVersion(), $this->sdk->getVersion());
        $this->sdk->setVersion('3.11');
        $this->assertEquals('3.11', $this->sdk->getVersion());
    }

    public function testVersionsCanBeRead()
    {
        $this->assertContains($this->sdk->getCurrentStableSoapVersion(), $this->sdk->getVersions());
    }
}
