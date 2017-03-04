<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

abstract class AbstractAttribute
{
    private function __construct()
    {
    }

    public static function getConstants()
    {
        $klass = new \ReflectionClass(get_called_class());
        return $klass->getConstants();
    }
}
