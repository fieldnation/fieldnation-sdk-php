<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

use \SoapClient as PHPSoapClient;

class SoapClient implements ClientInterface
{
    const STABLE_SOAP_VERSION = '3.15';
    const SOAP_API_BASE = 'https://api.fieldnation.com';
    const WSDL_NAME = '/fieldnation.wsdl';
    private $wsdl;
    private $client;
    private $credentials;
    private $version;
    private $apiBase;
    private $classMapFactory;

    public function __construct(
        SDKCredentialsInterface $credentials,
        ClassMapFactoryInterface $classMapFactory,
        $version = null,
        $apiBase = null
    ) {
        $this->credentials = $credentials;
        $this->version = $version;
        $this->apiBase = ($apiBase ?: self::SOAP_API_BASE) . '/api';
        $this->setWSDL($version);
        $this->setClient();
        $this->setClassMapFactory($classMapFactory);
    }

    /**
     * Set the class map factory that can create the classes needed for the client's return types
     *
     * @param ClassMapFactoryInterface $factory
     * @return self
     */
    public function setClassMapFactory(ClassMapFactoryInterface $factory)
    {
        $this->classMapFactory = $factory;
        return $this;
    }

    /**
     * Initialize the SoapClient
     * @param $client
     * @return $this
     */
    public function setClient($client = null)
    {
        if ($client) {
            $this->client = $client;
        } else {
            $this->client = new PHPSoapClient($this->getWSDL());
            $this->client->__setLocation($this->apiBase . '/' . $this->version . '/');
        }
        return $this;
    }

    /**
     * Set the wsdl URI string based on the $version
     * @param $version string
     * @return $this
     */
    private function setWSDL($version)
    {
        // The FN api has a v prefix on the version
        $this->setVersion($version);
        $this->wsdl = $this->apiBase . '/' . $this->version . self::WSDL_NAME;
        return $this;
    }

    /**
     * Get the WSDL URI
     * @return string
     */
    public function getWSDL()
    {
        return $this->wsdl;
    }

    /**
     * Get all work orders by status
     *
     * @param $status
     * @return WorkOrderInterface[]
     */
    public function getWorkOrders($status)
    {
        if (!$status) {
            $status = null;
        }
        $listWorkOrderIds = $this->client->listWorkOrders($this->getLogin(), $status);
        $response = array();
        foreach ($listWorkOrderIds as $id) {
            $workOrder = $this->classMapFactory->getWorkOrder();
            $wo = new $workOrder();
            $wo->setClient($this);
            $wo->setId($id);
            $response[] = $wo;
        }
        return $response;
    }
    
    /**
     * Get a work order
     *
     * @param $workOrderId
     * @return WorkOrderInterface
     */
    public function getWorkOrder($workOrderId)
    {
        $wo = $this->client->getWorkOrder($this->getLogin(), $workOrderId);
        $woObj = null;
        if ($wo) {
            $workOrder = $this->classMapFactory->getWorkOrder();
            $woObj = new $workOrder();
            $woObj->setClient($this);
            $woObj->setId($workOrderId);
            $woObj->setGroup($wo->group ?: '')
                ->setAllowTechUploads($wo->techUploads)
                ->setWillAlertWhenPublished($wo->alertWhenPublished)
                ->setIsPrintable($wo->printLink);

            $serviceDescription = $this->classMapFactory->getServiceDescription();
            $serviceDescriptionObj = new $serviceDescription();
            $serviceDescriptionObj->setCategoryId($wo->description->category)
                ->setTitle($wo->description->title)
                ->setDescription($wo->description->description)
                ->setInstruction($wo->description->instructions);
            $woObj->setDescription($serviceDescriptionObj);

            $serviceLocation = $this->classMapFactory->getServiceLocation();
            $serviceLocationObj = new $serviceLocation();
            $serviceLocationObj->setType($wo->location->type)
                ->setName($wo->location->name)
                ->setAddress1($wo->location->address1)
                ->setAddress2($wo->location->address2)
                ->setCity($wo->location->city)
                ->setState($wo->location->state)
                ->setPostalCode($wo->location->zip)
                ->setCountry($wo->location->country)
                ->setContactName($wo->location->contactName)
                ->setContactPhone($wo->location->contactPhone)
                ->setContactEmail($wo->location->contactEmail);
            $woObj->setLocation($serviceLocationObj);

            $woObj->setStartTime($this->responseToTimeRange($wo->startTime));

            $payInfo = $this->classMapFactory->getPayInfo();
            $payInfoObj = new $payInfo();
            if ($wo->payInfo->fixed !== null) {
                $fixedPay = $this->classMapFactory->getFixedPay();
                $payFixed = new $fixedPay();
                $payFixed->setAmount($wo->payInfo->fixed->amount);
                $payInfoObj->setFixed($payFixed);
            }
            if ($wo->payInfo->perHour !== null) {
                $ratePay = $this->classMapFactory->getRatePay();
                $payPerHour = new $ratePay();
                $payPerHour->setRate($wo->payInfo->perHour->rate);
                $payPerHour->setMaxUnits($wo->payInfo->perHour->maxUnits);
                $payInfoObj->setPerHour($payPerHour);
            }
            if ($wo->payInfo->perDevice !== null) {
                $ratePay = $this->classMapFactory->getRatePay();
                $payDevice = new $ratePay();
                $payDevice->setRate($wo->payInfo->perDevice->rate);
                $payDevice->setMaxUnits($wo->payInfo->perDevice->maxUnits);
                $payInfoObj->setPerDevice($payDevice);
            }
            if ($wo->payInfo->blended !== null) {
                $blended = $this->classMapFactory->getBlendedPay();
                $payBlended = new $blended();
                $payBlended->setBaseAmount($wo->payInfo->blended->baseAmount);
                $payBlended->setBaseHours($wo->payInfo->blended->baseHours);
                $payBlended->setAdditionalHourlyRate($wo->payInfo->blended->additionalHourlyRate);
                $payBlended->setMaxAdditionalHours($wo->payInfo->blended->maxAdditionalHours);
                $payInfoObj->setBlended($payBlended);
            }
            $woObj->setPayInfo($payInfoObj);

            $woObj->setAdditionalFields($this->responseToAdditionalFields($wo->additionalFields));

            $labels = array();
            if (is_array($wo->labels)) {
                foreach ($wo->labels as $label) {
                    $labelClass = $this->classMapFactory->getLabel();
                    $labelObj = new $labelClass();
                    $labelObj->setId($label->labelId);
                    $labelObj->setName($label->labelName);
                    $labelObj->setHideFromTech($label->hideFromTech);
                    $labelObj->setTechCanEdit($label->techCanEdit);
                    $labels[] = $labelObj;
                }
            }
            $woObj->setLabels($labels);

            $closeoutRequirements = array();
            if (is_array($wo->closeoutReqs)) {
                foreach ($wo->closeoutReqs as $req) {
                    $closeoutRequirement = $this->classMapFactory->getCloseoutRequirement();
                    $closeoutRequirementObj = new $closeoutRequirement();
                    $closeoutRequirementObj->setName($req->closeout_requirement_name);
                    $closeoutRequirementObj->setDescription($req->closeout_requirement_desc);
                    $closeoutRequirementObj->setOrder($req->closeout_requirement_order);
                    $closeoutRequirements[] = $closeoutRequirementObj;
                }
            }
            $woObj->setCloseoutRequirements($closeoutRequirements);
        }
        return $woObj;
    }

    /**
     * Get the status of a work order
     *
     * @param $workOrderId
     * @return string
     */
    public function getWorkOrderStatus($workOrderId)
    {
        return $this->client->getWorkOrderStatus($this->getLogin(), $workOrderId);
    }

    /**
     * Get the assigned provider
     *
     * @param $workOrderId
     * @return TechnicianInterface
     */
    public function getWorkOrderAssignedProvider($workOrderId)
    {
        $provider = $this->client->getAssignedTech($this->getLogin(), $workOrderId);
        $providerObj = null;
        if ($provider) {
            $tech = $this->classMapFactory->getTechnician();
            $providerObj = new $tech();
            $providerObj->setId($provider->uid);
            $providerObj->setFirstName($provider->firstName);
            $providerObj->setLastName($provider->lastName);
            $providerObj->setCity($provider->city);
            $providerObj->setState($provider->state);
            $providerObj->setPostalCode($provider->zip);
            $providerObj->setAdditionalFields($this->responseToAdditionalFields($provider->additionalFields));
        }
        return $providerObj;
    }

    /**
     * Get the progress of a workorder
     *
     * @param $workOrderId
     * @param $providerId
     * @return ProgressInterface
     */
    public function getWorkOrderProgress($workOrderId, $providerId)
    {
        $progress = $this->client->getWorkOrderProgress($this->getLogin(), $workOrderId, $providerId);
        $progressObj = null;
        if ($progress) {
            $progressClass = $this->classMapFactory->getProgress();
            $progressObj = new $progressClass();
            $progressObj->setTotalDevices($progress->totalDevices);
            $progressObj->setTotalHours($progress->totalHours);
            $progressObj->setLoggedWork($progress->loggedWork);
            $uploads = array();
            if (is_array($progress->uploads)) {
                foreach ($progress->uploads as $upload) {
                    $techUpload = $this->classMapFactory->getTechUpload();
                    $uploadObj = new $techUpload();
                    $uploadObj->setFileName($upload->filename);
                    $uploadObj->setFileSize($upload->filesize);
                    $uploadObj->setDownloadUrl($upload->downloadUrl);
                    $uploads[] = $upload;
                }
            }
            $progressObj->setUploads($uploads);
            $progressObj->setWorkData($this->responseToAdditionalFields($progress->workData));
            $progressObj->setClosingNotes($progress->closingNotes);
            $progressObj->setIsAssignmentConfirmed($progress->assignmentConfirmed);
            $progressObj->setIsReadyToGo($progress->readyToGo);
            $workSchedule = array();
            if (is_array($progress->workSchedule)) {
                foreach ($progress->workSchedule as $schedule) {
                    $workSchedule[] = $this->responseToTimeRange($schedule, 'startTime', 'endTime');
                }
            }
            $progressObj->setWorkSchedule($workSchedule);
        }
        return $progressObj;
    }

    /**
     * Get the payment details for a work order
     *
     * @param $workOrderId
     * @return PaymentInterface
     */
    public function getWorkOrderPayment($workOrderId)
    {
        $payment = $this->client->getWorkOrderTotalPayment($this->getLogin(), $workOrderId);
        $paymentObj = null;
        if ($payment) {
            $paymentClass = $this->classMapFactory->getPayment();
            $paymentObj = new $paymentClass();

            $expenses = array();
            if (is_array($payment->expenses)) {
                foreach ($payment->expenses as $expense) {
                    $additionalExpense = $this->classMapFactory->getAdditionalExpense();
                    $expenseObj = new $additionalExpense();
                    $expenseObj->setId($expense->expenseID);
                    $expenseObj->setDescription($expense->description);
                    $expenseObj->setExpenseCategory($expense->expenseCategory);
                    $expenseObj->setAmount($expense->amount);
                    $expenseObj->setIsApproved($expense->approved);
                    $expenseObj->setQuantity($expense->quantity);
                    $expenseObj->setCustomExpenseId($expense->customExpenseId);
                    $expenseObj->setReasonDenied($expense->reasonDenied);
                    $expenses[] = $expense;
                }
            }
            $paymentObj->setExpenses($expenses);

            $deductions = array();
            if (is_array($payment->deductions)) {
                foreach ($payment->deductions as $deduction) {
                    $paymentDeduction = $this->classMapFactory->getPaymentDeduction();
                    $deductionObj = new $paymentDeduction();
                    $deductionObj->setType($deduction->type);
                    $deductionObj->setDescription($deduction->description);
                    $deductionObj->setAmount($deduction->amount);
                    $deductions[] = $deductionObj;
                }
            }
            $paymentObj->setDeductions($deductions);
            $paymentObj->setLaborEarned($payment->laborEarned);
            $paymentObj->setTotalApprovedExpenses($payment->totalApprovedExpenses);
            $paymentObj->setTotalDeductions($payment->totalDeductions);
            $paymentObj->setPaymentAmount($payment->paymentAmount);
            $paymentObj->setCancelFee($payment->cancelFee);
        }
        return $paymentObj;
    }

    /**
     * Get all of the messages for a work order
     *
     * @param $workOrderId
     * @return MessageInterface[]
     */
    public function getWorkOrderMessages($workOrderId)
    {
        $messages = $this->client->getWorkOrderMessages($this->getLogin(), $workOrderId);
        $response = array();
        if (is_array($messages)) {
            foreach ($messages as $message) {
                $messageClass = $this->classMapFactory->getMessage();
                $messageObj = new $messageClass();
                $messageObj->setFrom($message->from);
                $messageObj->setFromType($message->fromType);
                $messageObj->setDate($message->date);
                $messageObj->setMessage($message->message);
                $response[] = $messageObj;
            }
        }
        return $response;
    }

    /**
     * Get all of the attached documents for a work order
     *
     * @param $workOrderId
     * @return DocumentInterface[]
     */
    public function getWorkOrderAttachedDocuments($workOrderId)
    {
        $documents = $this->client->listAttachedCompanyDocuments($this->getLogin(), $workOrderId);
        return $this->responseToDocuments($documents);
    }

    /**
     * Get all of the tracked shipments for a work order
     *
     * @param $workOrderId
     * @return ShipmentInterface[]
     */
    public function getWorkOrderShipments($workOrderId)
    {
        $shipments = $this->client->getWorkorderShipments($this->getLogin(), $workOrderId);
        $response = array();
        if (is_array($shipments)) {
            foreach ($shipments as $shipment) {
                $shipmentClass = $this->classMapFactory->getShipment();
                $shipmentObj = new $shipmentClass();
                $shipmentObj->setId($shipment->shipmentTrackingId);
                $shipmentObj->setVendor($shipment->vendor);
                $shipmentObj->setDescription($shipment->description);
                $shipmentObj->setStatus($shipment->status);
                $shipmentObj->setLastActivityDate(self::convertToDateTime($shipment->lastActivityDate));
                $response[] = $shipmentObj;
            }
        }
        return $response;
    }

    /**
     * Get all of the projects for your company
     *
     * @return ProjectInterface[]
     */
    public function getProjects()
    {
        $projects = $this->client->getProjects($this->getLogin());
        $response = array();
        if (is_array($projects)) {
            foreach ($projects as $project) {
                $response[] = $this->responseToProject($this, $project);
            }
        }
        return $response;
    }

    /**
     * Get a project
     *
     * @param $projectId
     * @return ProjectInterface
     */
    public function getProject($projectId)
    {
        $project = $this->client->getProjectDetails($this->getLogin(), $projectId);
        $projectObj = null;
        // getProjectDetails returning array instead of just Project
        if ($project && count($project) == 1) {
            $projectObj = $this->responseToProject($this, $project[0]);
        }
        return $projectObj;
    }

    /**
     * Convert a tracking number into FN shipping id
     * @param $trackingId
     * @return TrackingToShipmentResultInterface
     */
    public function convertTrackingIdToShippingId($trackingId)
    {
        $shippingId = $this->client->getShipmentIDFromVendorID($this->getLogin(), $trackingId);
        $shippingIdObj = null;
        if ($shippingId) {
            $shippingIdObj = new TrackingToShipmentResult();
            $shippingIdObj->setShipmentId($shippingId->workorderShipmentId);
            $shippingIdObj->setWorkOrderId($shippingId->workorderId);
            $shippingIdObj->setSuccessful($shippingId->found);
        }
        return $shippingIdObj;
    }

    /**
     * @param $shipmentId
     * @return ShipmentHistoryInterface
     */
    public function getShipmentHistory($shipmentId)
    {
        $shipmentHistory = $this->client->getWorkorderShipmentHistory($this->getLogin(), $shipmentId);
        $shipmentHistoryObj = null;
        if ($shipmentHistory) {
            $shipmentHistoryClass = $this->classMapFactory->getShipmentHistory();
            $shipmentHistoryObj = new $shipmentHistoryClass();
            $shipmentHistoryObj->setId($shipmentHistory->shipmentTrackingId);
            $shipmentHistoryObj->setVendor($shipmentHistory->vendor);
            $shipmentHistoryObj->setDescription($shipmentHistory->description);
            $shipmentHistoryObj->setStatus($shipmentHistory->status);
            $shipmentHistoryObj->setLastActivityDate(self::convertToDateTime($shipmentHistory->lastActivityDate));
            $historys = array();
            if (is_array($shipmentHistory->shipmentHistory)) {
                foreach ($shipmentHistory->shipmentHistory as $history) {
                    $historyClass = $this->classMapFactory->getHistory();
                    $historyObj = new $historyClass();
                    $historyObj->setEntryDate($history->entry_date);
                    $historyObj->setDescription($history->description);
                    $historys[] = $historyObj;
                }
            }
            $shipmentHistoryObj->setShipmentHistory($historys);
        }
        return $shipmentHistoryObj;
    }

    /**
     * Get all of the documents for your company.
     *
     * @return DocumentInterface[]
     */
    public function getDocuments()
    {
        $documents = $this->client->listCompanyDocuments($this->getLogin());
        return $this->responseToDocuments($documents);
    }

    /**
     * Create a work order.
     *
     * @param WorkOrderInterface $wo
     * @param $useTemplate
     * @return ResultInterface
     */
    public function createWorkOrder(WorkOrderSerializerInterface $wo, $useTemplate)
    {
        $result = $this->client->createWorkOrder(
            $this->getLogin(),
            self::workorderToStdClass($wo),
            $useTemplate
        );

        $result = self::responseToResult($result);
        $labels = $wo->getLabels();
        if (count($labels) > 0 && $result->wasSuccessful()) {
            foreach ($labels as $label) {
                $this->setLabelOnWorkOrder($result->getWorkOrderId(), $label->getName());
            }
        }
        return $result;
    }

    /**
     * Publish a work order.
     *
     * @param $workOrderId
     * @return ResultInterface
     */
    public function publishWorkOrder($workOrderId)
    {
        $result = $this->client->publishWorkOrder($this->getLogin(), $workOrderId);
        return self::responseToResult($result);
    }

    /**
     * Route a work order.
     *
     * @param $workOrderId
     * @param $groupId
     * @return ResultInterface
     */
    public function routeWorkOrderToGroup($workOrderId, $groupId)
    {
        $result = $this->client->routeWorkOrderToGroup($this->getLogin(), $workOrderId, $groupId);
        return self::responseToResult($result);
    }

    /**
     * Route a work order.
     *
     * @param $workOrderId
     * @param $providerId
     * @return ResultInterface
     */
    public function routeWorkOrderToProvider($workOrderId, $providerId)
    {
        $result = $this->client->routeWorkOrderToProvider($this->getLogin(), $workOrderId, $providerId);
        return self::responseToResult($result);
    }

    /**
     * Mark a work order as approved.
     *
     * @param $workOrderId
     * @return ResultInterface
     */
    public function approveWorkOrder($workOrderId)
    {
        $result = $this->client->approveWorkOrder($this->getLogin(), $workOrderId);
        return self::responseToResult($result);
    }

    /**
     * Cancel a work order.
     *
     * @param $workOrderId
     * @param $willAcceptFees
     * @param $revertRequestReason
     * @return ResultInterface
     */
    public function cancelWorkOrder($workOrderId, $willAcceptFees, $revertRequestReason)
    {
        $result = $this
            ->client
            ->cancelWorkOrder($this->getLogin(), $workOrderId, $willAcceptFees, $revertRequestReason);
        return self::responseToResult($result);
    }

    /**
     * Attach a document to a work order.
     *
     * @param $workOrderId
     * @param $documentId
     * @return ResultInterface
     */
    public function attachDocumentToWorkOrder($workOrderId, $documentId)
    {
        $result = $this->client->attachCompanyDocument($this->getLogin(), $documentId, $workOrderId);
        return self::responseToResult($result);
    }

    /**
     * Detach a document from a work order.
     *
     * @param $workOrderId
     * @param $documentId
     * @return ResultInterface
     */
    public function detachDocumentFromWorkOrder($workOrderId, $documentId)
    {
        $result = $this->client->detachCompanyDocument($this->getLogin(), $documentId, $workOrderId);
        return self::responseToResult($result);
    }

    /**
     * Add a message to a work order.
     *
     * @param $workOrderId
     * @param $messageText
     * @param $messageMode 1 = Internal Note, 2 = Assigned Tech, 3 = Requesting providers, 4 = Routed to providers
     * @return ResultInterface
     */
    public function addMessageToWorkOrder($workOrderId, $messageText, $messageMode)
    {
        $result = $this->client->addMessage($this->getLogin(), $workOrderId, $messageText, $messageMode);
        return self::responseToResult($result);
    }

    /**
     * Set a custom field on a work order
     *
     * @param $workOrderId
     * @param $fieldName
     * @param $fieldValue
     * @return ResultInterface
     */
    public function setCustomFieldOnWorkOrder($workOrderId, $fieldName, $fieldValue)
    {
        $result = $this->client->setCustomField($this->getLogin(), $workOrderId, $fieldName, $fieldValue);
        return self::responseToResult($result);
    }

    /**
     * Set a label on a work order
     *
     * @param $workOrderId
     * @param $labelName
     * @return ResultInterface
     */
    public function setLabelOnWorkOrder($workOrderId, $labelName)
    {
        $result = $this->client->setLabelOnWorkorder($this->getLogin(), $workOrderId, $labelName);
        return self::responseToResult($result);
    }

    /**
     * Unset a label on a work order
     *
     * @param $workOrderId
     * @param $labelName
     * @return ResultInterface
     */
    public function unsetLabelOnWorkOrder($workOrderId, $labelName)
    {
        $result = $this->client->setLabelOnWorkorder($this->getLogin(), $workOrderId, $labelName);
        return self::responseToResult($result);
    }

    /**
     * Mark a closeout requirement as completed
     *
     * @param $workOrderId
     * @param $closeoutName
     * @return ResultInterface
     */
    public function satisfyCloseoutOnWorkOrder($workOrderId, $closeoutName)
    {
        $result = $this->client->satisfyCloseout($this->getLogin(), $workOrderId, $closeoutName);
        // converting response from string to Result
        $resultObj = new \stdClass();
        $resultObj->message = $result;
        $resultObj->success = $resultObj->message === 'Closeout Requirement Satisfied';
        return self::responseToResult($resultObj);
    }

    /**
     * Delete a Field Nation shipment from a work order
     *
     * @param $shipmentId
     * @return string
     */
    public function deleteShipment($shipmentId)
    {
        $result = $this->client->deleteShipmentOnWorkorder($this->getLogin(), $shipmentId);
        return $result;
    }

    /**
     * Add a shipment to Field Nation
     *
     * @param $workOrderId
     * @param ShipmentInterface $shipment
     * @return ResultInterface
     */
    public function addShipment($workOrderId, ShipmentInterface $shipment)
    {
        $result = $this->client->addShipmentOnWorkorder(
            $this->getLogin(),
            $workOrderId,
            $shipment->getDescription(),
            $shipment->getVendor(),
            $shipment->getTrackingId(),
            null, // history entry description will default to 'New shipment added'
            'to_site'
        );
        
        return $result;
    }

    /**
     * Update the schedule for a work order
     *
     * @param $workOrderId
     * @param TimeRangeInterface $range
     * @return ResultInterface
     */
    public function updateWorkOrderSchedule($workOrderId, TimeRangeInterface $range)
    {
        $result = $this->client->updateSchedule(
            $this->getLogin(),
            $workOrderId,
            $range->getTimeBegin()->format(\DATE_ATOM),
            $range->getTimeEnd()->format(\DATE_ATOM)
        );
        return self::responseToResult($result);
    }

    /**
     * set the version
     *
     * @param $version
     * @return void
     */
    private function setVersion($version)
    {
        $this->version = !ctype_alpha($version[0]) ? 'v'.$version : $version;
    }

    /**
     * return the login credentials to use for api call
     *
     * @param $version
     * @return \stdClass
     */
    private function getLogin()
    {
        $login = new \stdClass();
        $login->customerID = $this->credentials->getCustomerId();
        $login->apiKey = $this->credentials->getApiKey();
        $login->effectiveUser = $this->credentials->getEffectiveUser();
        return $login;
    }

    /**
     * return additionalFieldResp converted into an AdditionalField
     *
     * @param $additionalFieldResp
     * @return AdditionalFieldInterface
     */
    private function responseToAdditionalField($additionalFieldResp)
    {
        $additionalFieldClass = $this->classMapFactory->getAdditionalField();
        $additionalField = new $additionalFieldClass();
        $additionalField->setName($additionalFieldResp->name);
        if ($additionalFieldResp->value !== null) {
            $additionalField->setValue($additionalFieldResp->value);
        }
        return $additionalField;
    }

    /**
     * return additionalFieldsResp converted into an array AdditionalField
     *
     * @param $additionalFieldsResp
     * @return AdditionalFieldInterface[]
     */
    private function responseToAdditionalFields($additionalFieldsResp)
    {
        $additionalFields = array();
        foreach ($additionalFieldsResp as $field) {
            $additionalFields[] = $this->responseToAdditionalField($field);
        }
        return $additionalFields;
    }

    /**
     * return timeRangeResp converted into a TimeRange
     *
     * @param $additionalFieldsResp
     * @param $startProp
     * @param $endProp
     * @return TimeRangeInterface
     */
    private function responseToTimeRange($timeRangeResp, $startProp = 'timeBegin', $endProp = 'timeEnd')
    {
        $timeRange = $this->classMapFactory->getTimeRange();
        $timeRangeObj = new $timeRange();
        $timeRangeObj
            ->setTimeBegin(self::convertToDateTime($timeRangeResp->$startProp))
            ->setTimeEnd(self::convertToDateTime($timeRangeResp->$endProp));
        return $timeRangeObj;
    }

    /**
     * return a DateTime object from a given string in \DateTime::ATOM format
     *
     * @param $dateTime
     * @return \DateTime
     */
    private static function convertToDateTime($dateTime)
    {
        return \DateTime::createFromFormat(\DateTime::ATOM, $dateTime, new \DateTimeZone('UTC'));
    }

    /**
     * return projectResp converted into Project
     *
     * @param ClientInterface $client
     * @param $projectResp
     * @return Project
     */

    private function responseToProject(ClientInterface $client, $projectResp)
    {
        $projectClass = $this->classMapFactory->getProject();
        $projectObj = new $projectClass($client);
        $projectObj->setId($projectResp->projectId);
        $projectObj->setIsEnabled($projectResp->isEnabled);
        $projectObj->setName($projectResp->projectName);
        $templates = array();
        if (!empty($projectResp->templates)) {
            foreach ($projectResp->templates as $template) {
                $templateClass = $this->classMapFactory->getTemplate();
                $templateObj = new $templateClass();
                $templateObj->setId($template->workorder_id);
                $templateObj->setDescription($template->template_description);
                $templates[] = $templateObj;
            }
        }
        $projectObj->setTemplates($templates);
        $managers = array();
        if (is_array($projectResp->managers)) {
            foreach ($projectResp->managers as $manager) {
                $managerClass = $this->classMapFactory->getManager();
                $managerObj = new $managerClass();
                $managerObj->setId($manager->user_id);
                $managerObj->setFullName($manager->full_name);
                $managers[] = $managerObj;
            }
        }
        $projectObj->setManagers($managers);
        $customFields = array();
        if (is_array($projectResp->customFields)) {
            foreach ($projectResp->customFields as $field) {
                $fieldClass = $this->classMapFactory->getCustomField();
                $fieldObj = new $fieldClass();
                $fieldObj->setId($field->custom_field_id);
                $fieldObj->setName($field->custom_field_name);
                $customFields[] = $fieldObj;
            }
        }
        $projectObj->setCustomFields($customFields);
        return $projectObj;
    }

    /**
     * return documentsResp converted into Document[]
     *
     * @param $documentsResp
     * @return Document[]
     */
    private function responseToDocuments($documentsResp)
    {
        $response = array();
        if (is_array($documentsResp)) {
            foreach ($documentsResp as $document) {
                $documentClass = $this->classMapFactory->getDocument();
                $documentObj = new $documentClass();
                $documentObj->setId($document->documentID);
                $documentObj->setTitle($document->title);
                $documentObj->setDescription($document->description);
                $documentObj->setType($document->type);
                $documentObj->setUpdatedTime(self::convertToDateTime($document->updatedTime));
                $response[] = $documentObj;
            }
        }
        return $response;
    }

    /**
     * return resultResp converted into Result
     *
     * @param $resultResp
     * @return Result
     */
    private static function responseToResult($resultResp)
    {
        if (!$resultResp) {
            return new FailureResult('No response revceived');
        } else {
            $response = null;
            if ($resultResp->success === true) {
                $response = new SuccessResult($resultResp->message);
            } else {
                $response = new FailureResult($resultResp->message);
            }
            if (isset($resultResp->workorderID)) {
                $response->setWorkOrderId($resultResp->workorderID);
            }
            return $response;
        }
    }

    /**
     * return wo converted into \stdClass
     *
     * @param WorkOrderSerializerInterface $wo
     * @return \stdClass
     */
    private static function workorderToStdClass(WorkOrderSerializerInterface $wo)
    {
        $workorder = new \stdClass();
        $workorder->group = $wo->getGroup();
        $workorder->techUploads = $wo->getAllowTechUploads();
        $workorder->alertWhenPublished = $wo->getWillAlertWhenPublished();
        $workorder->printLink = $wo->getIsPrintable();

        $descriptionObj = $wo->getDescription();
        $workorder->description = null;
        if ($descriptionObj) {
            $workorder->description = new \stdClass();
            $workorder->description->category = $descriptionObj->getCategoryId();
            $workorder->description->title = $descriptionObj->getTitle();
            $workorder->description->description = $descriptionObj->getDescription();
            $workorder->description->instructions = $descriptionObj->getInstruction();
        }

        $locationObj = $wo->getLocation();
        $workorder->location = null;
        if ($locationObj) {
            $workorder->location = new \stdClass();
            $workorder->location->type = $locationObj->getType();
            $workorder->location->name = $locationObj->getName();
            $workorder->location->address1 = $locationObj->getAddress1();
            $workorder->location->address2 = $locationObj->getAddress2();
            $workorder->location->city = $locationObj->getCity();
            $workorder->location->state = $locationObj->getState();
            $workorder->location->zip = $locationObj->getPostalCode();
            $workorder->location->country = $locationObj->getCountry();
            $workorder->location->contactName = $locationObj->getContactName();
            $workorder->location->contactPhone = $locationObj->getContactPhone();
            $workorder->location->contactEmail = $locationObj->getContactEmail();
        }
        
        $startTime = $wo->getStartTime();
        $workorder->startTime = null;
        if ($startTime) {
            $workorder->startTime = new \stdClass();
            $workorder->startTime->timeBegin = $startTime->getTimeBegin()->format(\DATE_ATOM);

            // The timeEnd property is not a required field.
            $workorder->startTime->timeEnd = null;
            if ($endTime = $startTime->getTimeEnd()) {
                $workorder->startTime->timeEnd = $endTime->format(\DATE_ATOM);
            }
        }

        $payInfo = $wo->getPayInfo();
        $workorder->payInfo = null;
        if ($payInfo) {
            $workorder->payInfo = new \stdClass();
            $payFixed = $payInfo->getFixed();
            $workorder->payInfo->fixed = null;
            if ($payFixed) {
                $workorder->payInfo->fixed = new \stdClass();
                $workorder->payInfo->fixed->amount = $payFixed->getAmount();
            }
            $payPerHour = $payInfo->getPerHour();
            $workorder->payInfo->perHour = null;
            if ($payPerHour) {
                $workorder->payInfo->perHour = new \stdClass();
                $workorder->payInfo->perHour->rate = $payPerHour->getRate();
                $workorder->payInfo->perHour->maxUnits = $payPerHour->getMaxUnits();
            }
            $payPerDevice = $payInfo->getPerDevice();
            $workorder->payInfo->perDevice = null;
            if ($payPerDevice) {
                $workorder->payInfo->perDevice = new \stdClass();
                $workorder->payInfo->perDevice->rate = $payPerDevice->getRate();
                $workorder->payInfo->perDevice->maxUnits = $payPerDevice->getMaxUnits();
            }
            $payBlended = $payInfo->getBlended();
            $workorder->payInfo->blended = null;
            if ($payBlended) {
                $workorder->payInfo->blended = new \stdClass();
                $workorder->payInfo->blended->baseAmount = $payBlended->getBaseAmount();
                $workorder->payInfo->blended->baseHours = $payBlended->getBaseHours();
                $workorder->payInfo->blended->additionalHourlyRate = $payBlended->getAdditionalHourlyRate();
                $workorder->payInfo->blended->maxAdditionalHours = $payBlended->getMaxAdditionalHours();
            }
        }

        $additionalFields = $wo->getAdditionalFields();
        $workorder->additionalFields = array();
        if (is_array($additionalFields)) {
            foreach ($additionalFields as $fieldObj) {
                $field = new \stdClass();
                $field->name = $fieldObj->getName();
                $field->value = $fieldObj->getValue();
                $workorder->additionalFields[] = $field;
            }
        }

        $labels = $wo->getLabels();
        $workorder->labels = array();
        if (is_array($labels)) {
            foreach ($labels as $labelObj) {
                $label = new \stdClass();
                $label->labelId = $labelObj->getId();
                $label->labelName = $labelObj->getName();
                $label->hideFromTech = $labelObj->hideFromTech();
                $label->techCanEdit = $labelObj->techCanEdit();
                $workorder->labels[] = $label;
            }
        }

        $closeoutRequirements = $wo->getCloseoutRequirements();
        $workorder->closeoutReqs = array();
        if (is_array($closeoutRequirements)) {
            foreach ($closeoutRequirements as $closeoutRequirementObj) {
                $req = new \stdClass();
                $req->closeout_requirement_name = $closeoutRequirementObj->getName();
                $req->closeout_requirement_desc = $closeoutRequirementObj->getDescription();
                $req->closeout_requirement_order = $closeoutRequirementObj->getOrder();
                $workorder->closeoutReqs[] = $req;
            }
        }

        return $workorder;
    }
}
