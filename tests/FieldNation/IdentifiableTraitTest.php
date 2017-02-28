<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;

use FieldNation\IdentifiableTrait;

class IdentifiableTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetId()
    {
        $id = rand();
        $mock = $this->getMockForTrait(IdentifiableTrait::class);
        $mock->setId($id);
        $this-> assertEquals($id, $mock->getId());
    }

    public function testSetIdReturnsSelf()
    {
        $mock = $this->getMockForTrait(IdentifiableTrait::class);
        $this->assertEquals($mock, $mock->setId(rand()));
    }

    public function testSetIdCastsInteger()
    {
        $mock = $this->getMockForTrait(IdentifiableTrait::class);
        $id = 100.1;
        $mock->setId($id);
        $this->assertTrue(is_float($id));
        $this->assertTrue(is_integer($mock->getId()));
        $this->assertFalse(is_float($mock->getId()));
    }
}
