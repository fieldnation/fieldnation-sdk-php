<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
use FieldNation\SDK;
use FieldNation\ClassMapFactoryInterface;

// Default configuration
SDK::configure(function (ClassMapFactoryInterface $factory) {
    $factory->setAdditionalExpense(\FieldNation\AdditionalExpense::class);
    $factory->setAdditionalField(\FieldNation\AdditionalField::class);
    $factory->setBlendedPay(\FieldNation\BlendedPay::class);
    //$factory->setCheckInOut(\FieldNation\CheckInOut::class);
    $factory->setCloseoutRequirement(\FieldNation\CloseoutRequirement::class);
    $factory->setCustomField(\FieldNation\CustomField::class);
    $factory->setDocument(\FieldNation\Document::class);
    $factory->setFixedPay(\FieldNation\FixedPay::class);
    $factory->setGroup(\FieldNation\Group::class);
    $factory->setHistory(\FieldNation\History::class);
    $factory->setLabel(\FieldNation\Label::class);
    $factory->setMessage(\FieldNation\Message::class);
    $factory->setPayInfo(\FieldNation\PayInfo::class);
    $factory->setPaymentDeduction(\FieldNation\PaymentDeduction::class);
    $factory->setPayment(\FieldNation\Payment::class);
    //$factory->setProblem(\FieldNation\Problem::class);
    $factory->setProgress(\FieldNation\Progress::class);
    $factory->setProject(\FieldNation\Project::class);
    $factory->setRatePay(\FieldNation\RatePay::class);
    $factory->setServiceDescription(\FieldNation\ServiceDescription::class);
    $factory->setServiceLocation(\FieldNation\ServiceLocation::class);
    $factory->setShipmentHistory(\FieldNation\ShipmentHistory::class);
    $factory->setShipment(\FieldNation\Shipment::class);
    $factory->setTechnician(\FieldNation\Technician::class);
    $factory->setTemplate(\FieldNation\Template::class);
    $factory->setTimeRange(\FieldNation\TimeRange::class);
    $factory->setWorkLog(\FieldNation\WorkLog::class);
    $factory->setWorkOrder(\FieldNation\WorkOrder::class);
});
