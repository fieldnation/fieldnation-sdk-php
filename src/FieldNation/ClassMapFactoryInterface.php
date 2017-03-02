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
     * @param AdditionalExpenseInterface $additionalExpense
     * @return self
     */
    public function setAdditionalExpense(AdditionalExpenseInterface $additionalExpense);
    /**
     * @return AdditionalExpenseInterface::class
     */
    public function getAdditionalExpense();

    /**
     * @param AdditionalFieldInterface $additionalField
     * @return self
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField);

    /**
     * @return AdditionalFieldInterface::class
     */
    public function getAdditionalField();

    /**
     * @param BlendedPayInterface $blendedPay
     * @return self
     */
    public function setBlendedPay(BlendedPayInterface $blendedPay);

    /**
     * @return BlendedPayInterface::class
     */
    public function getBlendedPay();

    /**
     * @param CheckInOutInterface $checkInOut
     * @return self
     */
    public function setCheckInOut(CheckInOutInterface $checkInOut);

    /**
     * @return CheckInOutInterface::class
     */
    public function getCheckInOut();

    /**
     * @param CloseoutRequirementInterface $closeoutRequirement
     * @return self
     */
    public function setCloseoutRequirement(CloseoutRequirementInterface $closeoutRequirement);

    /**
     * @return CloseoutRequirementInterface::class
     */
    public function getCloseoutRequirement();

    /**
     * @param CustomFieldInterface $customField
     * @return self
     */
    public function setCustomField(CustomFieldInterface $customField);

    /**
     * @return CustomFieldInterface::class
     */
    public function getCustomField();

    /**
     * @param DocumentInterface $document
     * @return self
     */
    public function setDocument(DocumentInterface $document);

    /**
     * @return DocumentInterface::class
     */
    public function getDocument();

    /**
     * @param FixedPayInterface $fixedPay
     * @return self
     */
    public function setFixedPay(FixedPayInterface $fixedPay);

    /**
     * @return FixedPayInterface::class
     */
    public function getFixedPay();

    /**
     * @param GroupInterface $group
     * @return self
     */
    public function setGroup(GroupInterface $group);

    /**
     * @return GroupInterface::class
     */
    public function getGroup();

    /**
     * @param HistoryInterface $history
     * @return self
     */
    public function setHistory(HistoryInterface $history);

    /**
     * @return HistoryInterface::class
     */
    public function getHistory();

    /**
     * @param LabelInterface $label
     * @return self
     */
    public function setLabel(LabelInterface $label);

    /**
     * @return LabelInterface
     */
    public function getLabel();

    /**
     * @param MessageInterface $message
     * @return self
     */
    public function setMessage(MessageInterface $message);

    /**
     * @return MessageInterface::class
     */
    public function getMessage();

    /**
     * @param PayInfoInterface $payInfo
     * @return self
     */
    public function setPayInfo(PayInfoInterface $payInfo);

    /**
     * @return PayInfoInterface::class
     */
    public function getPayInfo();

    /**
     * @param PaymentDeductionInterface $paymentDeduction
     * @return self
     */
    public function setPaymentDeduction(PaymentDeductionInterface $paymentDeduction);

    /**
     * @return PaymentDeductionInterface::class
     */
    public function getPaymentDeduction();

    /**
     * @param PaymentInterface $payment
     * @return self
     */
    public function setPayment(PaymentInterface $payment);

    /**
     * @return PaymentInterface::class
     */
    public function getPayment();

    /**
     * @param ProblemInterface $problem
     * @return mixed
     */
    public function setProblem(ProblemInterface $problem);

    /**
     * @return ProblemInterface::class
     */
    public function getProblem();

    /**
     * @param ProgressInterface $progress
     * @return self
     */
    public function setProgress(ProgressInterface $progress);

    /**
     * @return ProblemInterface::class
     */
    public function getProgress();

    /**
     * @param ProjectInterface $project
     * @return self
     */
    public function setProject(ProjectInterface $project);

    /**
     * @return ProjectInterface::class
     */
    public function getProject();

    /**
     * @param RatePayInterface $ratePay
     * @return self
     */
    public function setRatePay(RatePayInterface $ratePay);

    /**
     * @return RatePayInterface::class
     */
    public function getRatePay();

    /**
     * @param ServiceDescriptionInterface $serviceDescription
     * @return self
     */
    public function setServiceDescription(ServiceDescriptionInterface $serviceDescription);

    /**
     * @return ServiceDescriptionInterface
     */
    public function getServiceDescription();

    /**
     * @param ServiceLocationInterface $serviceLocation
     * @return self
     */
    public function setServiceLocation(ServiceLocationInterface $serviceLocation);

    /**
     * @return ServiceLocationInterface::class
     */
    public function getServiceLocation();

    /**
     * @param ShipmentHistoryInterface $shipmentHistory
     * @return self
     */
    public function setShipmentHistory(ShipmentHistoryInterface $shipmentHistory);

    /**
     * @return ShipmentHistoryInterface::class
     */
    public function getShipmentHistory();

    /**
     * @param ShipmentInterface $shipment
     * @return self
     */
    public function setShipment(ShipmentInterface $shipment);

    /**
     * @return ShipmentInterface::class
     */
    public function getShipment();

    /**
     * @param TechnicianInterface $technician
     * @return self
     */
    public function setTechnician(TechnicianInterface $technician);

    /**
     * @return TechnicianInterface::class
     */
    public function getTechnician();

    /**
     * @param TechUploadInterface $techUpload
     * @return self
     */
    public function setTechUpload(TechUploadInterface $techUpload);

    /**
     * @return TechUploadInterface::class
     */
    public function getTechUpload();

    /**
     * @param TemplateInterface $template
     * @return self
     */
    public function setTemplate(TemplateInterface $template);

    /**
     * @return TemplateInterface::class
     */
    public function getTemplate();

    /**
     * @param TimeRangeInterface $timeRange
     * @return self
     */
    public function setTimeRange(TimeRangeInterface $timeRange);

    /**
     * @return TimeRangeInterface::class
     */
    public function getTimeRange();

    /**
     * @param WorkLogInterface $workLog
     * @return self
     */
    public function setWorkLog(WorkLogInterface $workLog);

    /**
     * @return WorkLogInterface::class
     */
    public function getWorkLog();

    /**
     * @param WorkOrderInterface $wo
     * @return self
     */
    public function setWorkOrder(WorkOrderInterface $wo);

    /**
     * @return WorkOrderInterface::class
     */
    public function getWorkOrder();
}
