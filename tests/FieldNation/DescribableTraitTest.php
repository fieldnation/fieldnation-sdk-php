<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;

use FieldNation\DescribableTrait;

class DescribableTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDescription()
    {
        $mock = $this->getMockForTrait(DescribableTrait::class);
        $mock->setDescription(true);
        $this->assertTrue($mock->getDescription());
    }

    public function testSetDescription()
    {
        $mock = $this->getMockForTrait(DescribableTrait::class);
        $this->assertEquals($mock, $mock->setDescription('foo'));
    }
}
