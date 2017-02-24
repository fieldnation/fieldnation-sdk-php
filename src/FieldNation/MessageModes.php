<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class MessageModes
{
    private function __construct() { }

    const INTERNAL_NOTE = 1;
    const ASSIGNED_TECH = 2;
    const REQUESTING_PROVIDERS = 3;
    const ROUTED_TO_PROVIDERS = 4;

    public static function getConstants()
    {
        $klass = new \ReflectionClass(__CLASS__);
        return $klass->getConstants();
    }
}