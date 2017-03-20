<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class TypeValidator
{
    /**
     * @throws \UnexpectedValueException
     * @param $expected - The expected interface
     * @param $actual - The class that was given
     */
    public static function validateType($expected, $actual)
    {
        $implementations = class_implements($actual);
        if (!in_array($expected, $implementations)) {
            throw new \UnexpectedValueException("The class $actual does not implement $expected.");
        }
    }

    public static function validatePrimitive($expected, $actual)
    {
        $options = array(
            'bool',
            'double',
            'float',
            'int',
            'integer',
            'numeric',
            'real',
            'string',
        );

        if (!in_array($expected, $options)) {
            $fmtOpts = implode(', ', $options);
            throw new \UnexpectedValueException("Cannot validate $expected type. Must be one of $fmtOpts.");
        }

        $isOfExpectedType = 'is_' . $expected;
        if (!$isOfExpectedType($actual)) {
            $actualType = gettype($actual);
            throw new \UnexpectedValueException("$expected is not a $actualType");
        }
    }

    /**
     * @param $expected - The type you're expecting
     * @param $actual - An array of a given type
     */
    public static function validateCollection($expected, $actual)
    {
        if (!is_array($actual)) {
            $msg = 'The $actual parameter must be an array. TypeValidator::validateCollection($expected, $actual);';
            throw new \UnexpectedValueException($msg);
        }

        foreach ($actual as $o) {
            self::validateType($expected, $o);
        }
    }

    public static function validateWorkOrderSerializerInterface(WorkOrderSerializerInterface $wo)
    {
        self::validate(ServiceDescriptionInterface::class, $wo->getDescription(), 'validateType', true);
        self::validate(ServiceLocationInterface::class, $wo->getLocation(), 'validateType', true);
        self::validate(TimeRangeInterface::class, $wo->getStartTime(), 'validateType', true);
        self::validate(PayInfoInterface::class, $wo->getPayInfo(), 'validateType', true);
        self::validate('bool', $wo->getAllowTechUploads(), 'validatePrimitive', true, 'allowTechUploads');
        self::validate('bool', $wo->getWillAlertWhenPublished(), 'validatePrimitive', true, 'willAlertWhenPublished');
        self::validate('bool', $wo->getIsPrintable(), 'validatePrimitive', true, 'isPrintable');

        // Optional Fields
        self::validate('string', $wo->getGroup(), 'validatePrimitive', false, 'group');
        self::validate(AdditionalFieldInterface::class, $wo->getAdditionalFields(), 'validateCollection', false);
        self::validate(LabelInterface::class, $wo->getLabels(), 'validateCollection', false);
        self::validate(
            CloseoutRequirementInterface::class,
            $wo->getCloseoutRequirements(),
            'validateCollection',
            false
        );
    }

    private static function validate($expected, $actual, $validator, $isRequired, $logName = null)
    {
        if (is_null($actual) && $isRequired) {
            $msg = $logName ?: $expected;
            throw new \InvalidArgumentException("$msg is required but is NULL.");
        }

        if (!is_null($actual)) {
            self::$validator($expected, $actual);
        }
    }
}
