<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
use FieldNation\SDK;
use FieldNation\ClassMapFactoryInterface;

// Default configuration
SDK::configure(function (ClassMapFactoryInterface $classMap) {
    $classMap->setAdditionalExpense(\FieldNation\AdditionalExpense::class);
    $classMap->setAdditionalField(\FieldNation\AdditionalField::class);
    $classMap->setBlendedPay(\FieldNation\BlendedPay::class);
    //$classMap->setCheckInOut(\FieldNation\CheckInOut::class);
    $classMap->setCloseoutRequirement(\FieldNation\CloseoutRequirement::class);
    $classMap->setCustomField(\FieldNation\CustomField::class);
    $classMap->setDocument(\FieldNation\Document::class);
    $classMap->setFixedPay(\FieldNation\FixedPay::class);
    $classMap->setGroup(\FieldNation\Group::class);
    $classMap->setHistory(\FieldNation\History::class);
    $classMap->setLabel(\FieldNation\Label::class);
    $classMap->setMessage(\FieldNation\Message::class);
    $classMap->setPayInfo(\FieldNation\PayInfo::class);
    $classMap->setPaymentDeduction(\FieldNation\PaymentDeduction::class);
    $classMap->setPayment(\FieldNation\Payment::class);
    //$classMap->setProblem(\FieldNation\Problem::class);
    $classMap->setProgress(\FieldNation\Progress::class);
    $classMap->setProject(\FieldNation\Project::class);
    $classMap->setRatePay(\FieldNation\RatePay::class);
    $classMap->setServiceDescription(\FieldNation\ServiceDescription::class);
    $classMap->setServiceLocation(\FieldNation\ServiceLocation::class);
    $classMap->setShipmentHistory(\FieldNation\ShipmentHistory::class);
    $classMap->setShipment(\FieldNation\Shipment::class);
    $classMap->setTechnician(\FieldNation\Technician::class);
    $classMap->setTemplate(\FieldNation\Template::class);
    $classMap->setTimeRange(\FieldNation\TimeRange::class);
    $classMap->setWorkLog(\FieldNation\WorkLog::class);
    $classMap->setWorkOrder(\FieldNation\WorkOrder::class);
});
