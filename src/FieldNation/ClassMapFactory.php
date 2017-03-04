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

    public static function get()
    {
        if (self::$instance == null) {
            self::$instance = new ClassMapFactory();
        }
        return self::$instance;
    }

    /**
     * @throws \TypeError
     * @param $additionalExpense
     * @return self
     */
    public function setAdditionalExpense($additionalExpense)
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
     * @param $additionalField
     * @return self
     */
    public function setAdditionalField($additionalField)
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
     * @param $blendedPay
     * @return self
     */
    public function setBlendedPay($blendedPay)
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
     * @param $checkInOut
     * @return self
     */
    public function setCheckInOut($checkInOut)
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
     * @param $closeoutRequirement
     * @return self
     */
    public function setCloseoutRequirement($closeoutRequirement)
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
     * @param $customField
     * @return self
     */
    public function setCustomField($customField)
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
     * @param $document
     * @return self
     */
    public function setDocument($document)
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
     * @param $fixedPay
     * @return self
     */
    public function setFixedPay($fixedPay)
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
     * @param $group
     * @return self
     */
    public function setGroup($group)
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
     * @param $history
     * @return self
     */
    public function setHistory($history)
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
     * @param $label
     * @return self
     */
    public function setLabel($label)
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
     * @param $message
     * @return self
     */
    public function setMessage($message)
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
     * @param $payInfo
     * @return self
     */
    public function setPayInfo($payInfo)
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
     * @param $paymentDeduction
     * @return self
     */
    public function setPaymentDeduction($paymentDeduction)
    {
        $this->validateType(PaymentDeductionInterface::class, $paymentDeduction);
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
     * @param $payment
     * @return self
     */
    public function setPayment($payment)
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
     * @param $problem
     * @return mixed
     */
    public function setProblem($problem)
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
     * @param $progress
     * @return self
     */
    public function setProgress($progress)
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
    public function setProject($project)
    {
        $this->validateType(ProjectInterface::class, $project);
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
     * @param $ratePay
     * @return self
     */
    public function setRatePay($ratePay)
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
     * @param $serviceDescription
     * @return self
     */
    public function setServiceDescription($serviceDescription)
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
     * @param $serviceLocation
     * @return self
     */
    public function setServiceLocation($serviceLocation)
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
     * @param $shipmentHistory
     * @return self
     */
    public function setShipmentHistory($shipmentHistory)
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
    public function setShipment($shipment)
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
     * @param $technician
     * @return self
     */
    public function setTechnician($technician)
    {
        $this->validateType(TechnicianInterface::class, $technician);
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
     * @param $techUpload
     * @return self
     */
    public function setTechUpload($techUpload)
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
    public function setTemplate($template)
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
     * @param $timeRange
     * @return self
     */
    public function setTimeRange($timeRange)
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
     * @param $workLog
     * @return self
     */
    public function setWorkLog($workLog)
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
     * @param $wo
     * @return self
     */
    public function setWorkOrder($wo)
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
            throw new \TypeError('The injected class ' . $actual . ' does not implement ' . $expected);
        }
    }
}
