<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ClassMapFactoryInterface
{
    /**
     * Get the factory
     * @return ClassMapFactoryInterface
     */
    public static function get();

    /**
     * @param $additionalExpense
     * @return self
     */
    public function setAdditionalExpense($additionalExpense);
    /**
     * @return AdditionalExpenseInterface::class
     */
    public function getAdditionalExpense();

    /**
     * @param $additionalField
     * @return self
     */
    public function setAdditionalField($additionalField);

    /**
     * @return AdditionalFieldInterface::class
     */
    public function getAdditionalField();

    /**
     * @param $blendedPay
     * @return self
     */
    public function setBlendedPay($blendedPay);

    /**
     * @return BlendedPayInterface::class
     */
    public function getBlendedPay();

    /**
     * @param $checkInOut
     * @return self
     */
    public function setCheckInOut($checkInOut);

    /**
     * @return CheckInOutInterface::class
     */
    public function getCheckInOut();

    /**
     * @param $closeoutRequirement
     * @return self
     */
    public function setCloseoutRequirement($closeoutRequirement);

    /**
     * @return CloseoutRequirementInterface::class
     */
    public function getCloseoutRequirement();

    /**
     * @param $customField
     * @return self
     */
    public function setCustomField($customField);

    /**
     * @return CustomFieldInterface::class
     */
    public function getCustomField();

    /**
     * @param $document
     * @return self
     */
    public function setDocument($document);

    /**
     * @return DocumentInterface::class
     */
    public function getDocument();

    /**
     * @param $fixedPay
     * @return self
     */
    public function setFixedPay($fixedPay);

    /**
     * @return FixedPayInterface::class
     */
    public function getFixedPay();

    /**
     * @param $group
     * @return self
     */
    public function setGroup($group);

    /**
     * @return GroupInterface::class
     */
    public function getGroup();

    /**
     * @param $history
     * @return self
     */
    public function setHistory($history);

    /**
     * @return HistoryInterface::class
     */
    public function getHistory();

    /**
     * @param $label
     * @return self
     */
    public function setLabel($label);

    /**
     * @return LabelInterface
     */
    public function getLabel();

    /**
     * @param $message
     * @return self
     */
    public function setMessage($message);

    /**
     * @return MessageInterface::class
     */
    public function getMessage();

    /**
     * @param $payInfo
     * @return self
     */
    public function setPayInfo($payInfo);

    /**
     * @return PayInfoInterface::class
     */
    public function getPayInfo();

    /**
     * @param $paymentDeduction
     * @return self
     */
    public function setPaymentDeduction($paymentDeduction);

    /**
     * @return PaymentDeductionInterface::class
     */
    public function getPaymentDeduction();

    /**
     * @param $payment
     * @return self
     */
    public function setPayment($payment);

    /**
     * @return PaymentInterface::class
     */
    public function getPayment();

    /**
     * @param $problem
     * @return mixed
     */
    public function setProblem($problem);

    /**
     * @return ProblemInterface::class
     */
    public function getProblem();

    /**
     * @param $progress
     * @return self
     */
    public function setProgress($progress);

    /**
     * @return ProblemInterface::class
     */
    public function getProgress();

    /**
     * @param $project
     * @return self
     */
    public function setProject($project);

    /**
     * @return ProjectInterface::class
     */
    public function getProject();

    /**
     * @param $ratePay
     * @return self
     */
    public function setRatePay($ratePay);

    /**
     * @return RatePayInterface::class
     */
    public function getRatePay();

    /**
     * @param $serviceDescription
     * @return self
     */
    public function setServiceDescription($serviceDescription);

    /**
     * @return ServiceDescriptionInterface
     */
    public function getServiceDescription();

    /**
     * @param $serviceLocation
     * @return self
     */
    public function setServiceLocation($serviceLocation);

    /**
     * @return ServiceLocationInterface::class
     */
    public function getServiceLocation();

    /**
     * @param $shipmentHistory
     * @return self
     */
    public function setShipmentHistory($shipmentHistory);

    /**
     * @return ShipmentHistoryInterface::class
     */
    public function getShipmentHistory();

    /**
     * @param $shipment
     * @return self
     */
    public function setShipment($shipment);

    /**
     * @return ShipmentInterface::class
     */
    public function getShipment();

    /**
     * @param $technician
     * @return self
     */
    public function setTechnician($technician);

    /**
     * @return TechnicianInterface::class
     */
    public function getTechnician();

    /**
     * @param $techUpload
     * @return self
     */
    public function setTechUpload($techUpload);

    /**
     * @return TechUploadInterface::class
     */
    public function getTechUpload();

    /**
     * @param $template
     * @return self
     */
    public function setTemplate($template);

    /**
     * @return TemplateInterface::class
     */
    public function getTemplate();

    /**
     * @param $timeRange
     * @return self
     */
    public function setTimeRange($timeRange);

    /**
     * @return TimeRangeInterface::class
     */
    public function getTimeRange();

    /**
     * @param $workLog
     * @return self
     */
    public function setWorkLog($workLog);

    /**
     * @return WorkLogInterface::class
     */
    public function getWorkLog();

    /**
     * @param $wo
     * @return self
     */
    public function setWorkOrder($wo);

    /**
     * @return WorkOrderInterface::class
     */
    public function getWorkOrder();
}
