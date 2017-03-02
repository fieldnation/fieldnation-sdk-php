<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class ClassMapFactory implements ClassMapFactoryInterface
{
    private static $instance = null;
    private $additionalExpense;
    private $additionalField;
    private $blendedPay;
    private $checkInOut;
    private $closeoutRequirement;
    private $customField;
    private $document;
    private $fixedPay;
    private $group;
    private $history;
    private $label;
    private $message;
    private $payInfo;
    private $paymentDeduction;
    private $payment;
    private $problem;
    private $progress;
    private $project;
    private $ratePay;
    private $serviceDescription;
    private $serviceLocation;
    private $shipmentHistory;
    private $shipment;
    private $technician;
    private $techUpload;
    private $template;
    private $timeRange;
    private $workLog;
    private $workOrder;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function get()
    {
        if (self::$instance == null) {
            self::$instance = new ClassMapFactory();
        }
        return self::$instance;
    }

    /**
     * @throws \TypeError
     * @param AdditionalExpenseInterface $additionalExpense
     * @return self
     */
    public function setAdditionalExpense(AdditionalExpenseInterface $additionalExpense)
    {
        $this->validateType(AdditionalExpenseInterface::class, $additionalExpense);
        $this->additionalExpense = $additionalExpense;
        return $this;
    }

    /**
     * @return AdditionalExpenseInterface::class
     */
    public function getAdditionalExpense()
    {
        return $this->additionalExpense;
    }

    /**
     * @throws \TypeError
     * @param AdditionalFieldInterface $additionalField
     * @return self
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField)
    {
        $this->validateType(AdditionalFieldInterface::class, $additionalField);
        $this->additionalField = $additionalField;
        return $this;
    }

    /**
     * @return AdditionalFieldInterface::class
     */
    public function getAdditionalField()
    {
        return $this->additionalField;
    }

    /**
     * @throws \TypeError
     * @param BlendedPayInterface $blendedPay
     * @return self
     */
    public function setBlendedPay(BlendedPayInterface $blendedPay)
    {
        $this->validateType(BlendedPayInterface::class, $blendedPay);
        $this->blendedPay = $blendedPay;
        return $this;
    }

    /**
     * @return BlendedPayInterface::class
     */
    public function getBlendedPay()
    {
        return $this->blendedPay;
    }

    /**
     * @throws \TypeError
     * @param CheckInOutInterface $checkInOut
     * @return self
     */
    public function setCheckInOut(CheckInOutInterface $checkInOut)
    {
        $this->validateType(CheckInOutInterface::class, $checkInOut);
        $this->checkInOut = $checkInOut;
        return $this;
    }

    /**
     * @return CheckInOutInterface::class
     */
    public function getCheckInOut()
    {
        return $this->checkInOut;
    }

    /**
     * @throws \TypeError
     * @param CloseoutRequirementInterface $closeoutRequirement
     * @return self
     */
    public function setCloseoutRequirement(CloseoutRequirementInterface $closeoutRequirement)
    {
        $this->validateType(CloseoutRequirementInterface::class, $closeoutRequirement);
        $this->closeoutRequirement = $closeoutRequirement;
        return $this;
    }

    /**
     * @return CloseoutRequirementInterface::class
     */
    public function getCloseoutRequirement()
    {
        return $this->closeoutRequirement;
    }

    /**
     * @throws \TypeError
     * @param CustomFieldInterface $customField
     * @return self
     */
    public function setCustomField(CustomFieldInterface $customField)
    {
        $this->validateType(CustomFieldInterface::class, $customField);
        $this->customField = $customField;
        return $this;
    }

    /**
     * @return CustomFieldInterface::class
     */
    public function getCustomField()
    {
        return $this->customField;
    }

    /**
     * @throws \TypeError
     * @param DocumentInterface $document
     * @return self
     */
    public function setDocument(DocumentInterface $document)
    {
        $this->validateType(DocumentInterface::class, $document);
        $this->document = $document;
        return $this;
    }

    /**
     * @return DocumentInterface::class
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @throws \TypeError
     * @param FixedPayInterface $fixedPay
     * @return self
     */
    public function setFixedPay(FixedPayInterface $fixedPay)
    {
        $this->validateType(FixedPayInterface::class, $fixedPay);
        $this->fixedPay = $fixedPay;
        return $this;
    }

    /**
     * @return FixedPayInterface::class
     */
    public function getFixedPay()
    {
        return $this->fixedPay;
    }

    /**
     * @throws \TypeError
     * @param GroupInterface $group
     * @return self
     */
    public function setGroup(GroupInterface $group)
    {
        $this->validateType(GroupInterface::class, $group);
        $this->group = $group;
        return $this;
    }

    /**
     * @return GroupInterface::class
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @throws \TypeError
     * @param HistoryInterface $history
     * @return self
     */
    public function setHistory(HistoryInterface $history)
    {
        $this->validateType(HistoryInterface::class, $history);
        $this->history = $history;
        return $this;
    }

    /**
     * @return HistoryInterface::class
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * @throws \TypeError
     * @param LabelInterface $label
     * @return self
     */
    public function setLabel(LabelInterface $label)
    {
        $this->validateType(LabelInterface::class, $label);
        $this->label = $label;
        return $this;
    }

    /**
     * @return LabelInterface
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @throws \TypeError
     * @param MessageInterface $message
     * @return self
     */
    public function setMessage(MessageInterface $message)
    {
        $this->validateType(MessageInterface::class, $message);
        $this->message = $message;
        return $this;
    }

    /**
     * @return MessageInterface::class
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @throws \TypeError
     * @param PayInfoInterface $payInfo
     * @return self
     */
    public function setPayInfo(PayInfoInterface $payInfo)
    {
        $this->validateType(PayInfoInterface::class, $payInfo);
        $this->payInfo = $payInfo;
        return $this;
    }

    /**
     * @return PayInfoInterface::class
     */
    public function getPayInfo()
    {
        return $this->payInfo;
    }

    /**
     * @throws \TypeError
     * @param PaymentDeductionInterface $paymentDeduction
     * @return self
     */
    public function setPaymentDeduction(PaymentDeductionInterface $paymentDeduction)
    {
        $this->validateType(PaymentInterface::class, $paymentDeduction);
        $this->paymentDeduction = $paymentDeduction;
        return $this;
    }

    /**
     * @return PaymentDeductionInterface::class
     */
    public function getPaymentDeduction()
    {
        return $this->paymentDeduction;
    }

    /**
     * @throws \TypeError
     * @param PaymentInterface $payment
     * @return self
     */
    public function setPayment(PaymentInterface $payment)
    {
        $this->validateType(PaymentInterface::class, $payment);
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return PaymentInterface::class
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @throws \TypeError
     * @param ProblemInterface $problem
     * @return mixed
     */
    public function setProblem(ProblemInterface $problem)
    {
        $this->validateType(ProblemInterface::class, $problem);
        $this->problem = $problem;
        return $this;
    }

    /**
     * @return ProblemInterface::class
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * @throws \TypeError
     * @param ProgressInterface $progress
     * @return self
     */
    public function setProgress(ProgressInterface $progress)
    {
        $this->validateType(ProgressInterface::class, $progress);
        $this->progress = $progress;
        return $this;
    }

    /**
     * @return ProblemInterface::class
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @throws \TypeError
     * @param ProjectInterface $project
     * @return self
     */
    public function setProject(ProjectInterface $project)
    {
        $this->validateType(ProblemInterface::class, $project);
        $this->project = $project;
        return $this;
    }

    /**
     * @return ProjectInterface::class
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @throws \TypeError
     * @param RatePayInterface $ratePay
     * @return self
     */
    public function setRatePay(RatePayInterface $ratePay)
    {
        $this->validateType(RatePayInterface::class, $ratePay);
        $this->ratePay = $ratePay;
        return $this;
    }

    /**
     * @return RatePayInterface::class
     */
    public function getRatePay()
    {
        return $this->ratePay;
    }

    /**
     * @throws \TypeError
     * @param ServiceDescriptionInterface $serviceDescription
     * @return self
     */
    public function setServiceDescription(ServiceDescriptionInterface $serviceDescription)
    {
        $this->validateType(ServiceDescriptionInterface::class, $serviceDescription);
        $this->serviceDescription = $serviceDescription;
        return $this;
    }

    /**
     * @return ServiceDescriptionInterface
     */
    public function getServiceDescription()
    {
        return $this->serviceDescription;
    }

    /**
     * @throws \TypeError
     * @param ServiceLocationInterface $serviceLocation
     * @return self
     */
    public function setServiceLocation(ServiceLocationInterface $serviceLocation)
    {
        $this->validateType(ServiceLocationInterface::class, $serviceLocation);
        $this->serviceLocation = $serviceLocation;
        return $this;
    }

    /**
     * @return ServiceLocationInterface::class
     */
    public function getServiceLocation()
    {
        return $this->serviceLocation;
    }

    /**
     * @throws \TypeError
     * @param ShipmentHistoryInterface $shipmentHistory
     * @return self
     */
    public function setShipmentHistory(ShipmentHistoryInterface $shipmentHistory)
    {
        $this->validateType(ShipmentInterface::class, $shipmentHistory);
        $this->shipmentHistory = $shipmentHistory;
        return $this;
    }

    /**
     * @return ShipmentHistoryInterface::class
     */
    public function getShipmentHistory()
    {
        return $this->shipmentHistory;
    }

    /**
     * @throws \TypeError
     * @param ShipmentInterface $shipment
     * @return self
     */
    public function setShipment(ShipmentInterface $shipment)
    {
        $this->validateType(ShipmentInterface::class, $shipment);
        $this->shipment = $shipment;
        return $this;
    }

    /**
     * @return ShipmentInterface::class
     */
    public function getShipment()
    {
        return $this->getShipment();
    }

    /**
     * @throws \TypeError
     * @param TechnicianInterface $technician
     * @return self
     */
    public function setTechnician(TechnicianInterface $technician)
    {
        $this->validateType(TechUploadInterface::class, $technician);
        $this->technician = $technician;
        return $this;
    }

    /**
     * @return TechnicianInterface::class
     */
    public function getTechnician()
    {
        return $this->technician;
    }

    /**
     * @throws \TypeError
     * @param TechUploadInterface $techUpload
     * @return self
     */
    public function setTechUpload(TechUploadInterface $techUpload)
    {
        $this->validateType(TechUploadInterface::class, $techUpload);
        $this->techUpload = $techUpload;
        return $this;
    }

    /**
     * @return TechUploadInterface::class
     */
    public function getTechUpload()
    {
        return $this->techUpload;
    }

    /**
     * @throws \TypeError
     * @param TemplateInterface $template
     * @return self
     */
    public function setTemplate(TemplateInterface $template)
    {
        $this->validateType(TemplateInterface::class, $template);
        $this->template = $template;
        return $this;
    }

    /**
     * @return TemplateInterface::class
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @throws \TypeError
     * @param TimeRangeInterface $timeRange
     * @return self
     */
    public function setTimeRange(TimeRangeInterface $timeRange)
    {
        $this->validateType(TimeRangeInterface::class, $timeRange);
        $this->timeRange = $timeRange;
        return $this;
    }

    /**
     * @return TimeRangeInterface::class
     */
    public function getTimeRange()
    {
        return $this->timeRange;
    }

    /**
     * @throws \TypeError
     * @param WorkLogInterface $workLog
     * @return self
     */
    public function setWorkLog(WorkLogInterface $workLog)
    {
        $this->validateType(WorkLogInterface::class, $workLog);
        $this->workLog = $workLog;
        return $this;
    }

    /**
     * @return WorkLogInterface::class
     */
    public function getWorkLog()
    {
        return $this->workLog;
    }

    /**
     * @throws \TypeError
     * @param WorkOrderInterface $wo
     * @return self
     */
    public function setWorkOrder(WorkOrderInterface $wo)
    {
        $this->validateType(WorkOrderInterface::class, $wo);
        $this->workOrder = $wo;
        return $this;
    }

    /**
     * @return WorkOrderInterface::class
     */
    public function getWorkOrder()
    {
        return $this->workOrder;
    }

    /**
     * @throws \TypeError
     * @param $expected - The expected interface
     * @param $actual - The class that was given
     */
    private function validateType($expected, $actual)
    {
        $implementations = class_implements($actual);
        if (!in_array($expected, $implementations)) {
            throw new \TypeError('The injected class ' . $expected . ' does not implement ' . $expected);
        }
    }
}
