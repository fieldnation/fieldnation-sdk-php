<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation\Tests;

use FieldNation\AdditionalFieldInterface;
use FieldNation\CloseoutRequirementInterface;
use FieldNation\GroupInterface;
use FieldNation\LabelInterface;
use FieldNation\PayInfoInterface;
use FieldNation\ServiceDescriptionInterface;
use FieldNation\ServiceLocationInterface;
use FieldNation\TimeRangeInterface;
use FieldNation\TypeValidator;
use FieldNation\WorkOrder;
use FieldNation\WorkOrderInterface;
use FieldNation\WorkOrderSerializerInterface;

class TypeValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testThrowsExceptionIfClassMismatch()
    {
        $this->expectException(\UnexpectedValueException::class);

        TypeValidator::validateType(\stdClass::class, WorkOrderInterface::class);
    }

    public function testDoesNotThrowIfClassIsCorrect()
    {
        TypeValidator::validateType(WorkOrderInterface::class, WorkOrder::class);
    }

    public function testWorkOrderSerializerInterfaceIsValidated()
    {
        $wo = $this->createMock(WorkOrderSerializerInterface::class);
        $description = $this->createMock(ServiceDescriptionInterface::class);
        $location = $this->createMock(ServiceLocationInterface::class);
        $time = $this->createMock(TimeRangeInterface::class);
        $payInfo = $this->createMock(PayInfoInterface::class);
        $allowTechUploads = true;
        $alertWhenPublished = false;
        $isPrintable = true;
        $additionalFields = array(
            $this->createMock(AdditionalFieldInterface::class),
            $this->createMock(AdditionalFieldInterface::class)
        );
        $labels = array(
            $this->createMock(LabelInterface::class),
            $this->createMock(LabelInterface::class)
        );
        $closeoutRequirements = array(
            $this->createMock(CloseoutRequirementInterface::class),
            $this->createMock(CloseoutRequirementInterface::class)
        );

        $wo->method('getDescription')->willReturn($description);
        $wo->method('getLocation')->willReturn($location);
        $wo->method('getStartTime')->willReturn($time);
        $wo->method('getPayInfo')->willReturn($payInfo);
        $wo->method('getAllowTechUploads')->willReturn($allowTechUploads);
        $wo->method('getWillAlertWhenPublished')->willReturn($alertWhenPublished);
        $wo->method('getIsPrintable')->willReturn($isPrintable);
        $wo->method('getAdditionalFields')->willReturn($additionalFields);
        $wo->method('getLabels')->willReturn($labels);
        $wo->method('getCloseoutRequirements')->willReturn($closeoutRequirements);

        TypeValidator::validateWorkOrderSerializerInterface($wo);
    }

    public function testValidatePrimitiveThrowsWhenOptionIsUnknown()
    {
        $this->expectException(\UnexpectedValueException::class);
        $msg = "Cannot validate array type. Must be one of bool, double, float, int, integer, numeric, real, string.";
        $this->expectExceptionMessage($msg);
        TypeValidator::validatePrimitive('array', \stdClass::class);
    }

    public function testValidatePrimitiveThrowsWhenTypeIsMismatched()
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessage('bool is not a string');
        TypeValidator::validatePrimitive('bool', 'foo');
    }

    public function testValidateCollectionThrowsIfNotAnArray()
    {
        $this->expectException(\UnexpectedValueException::class);
        $msg = 'The $actual parameter must be an array. TypeValidator::validateCollection($expected, $actual);';
        $this->expectExceptionMessage($msg);
        TypeValidator::validateCollection(\stdClass::class, 'foo');
    }
}
