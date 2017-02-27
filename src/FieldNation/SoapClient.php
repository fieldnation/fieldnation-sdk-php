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

    public function __construct(SDKCredentialsInterface $credentials, $version=NULL, $apiBase=NULL)
    {
        $this->credentials = $credentials;
        $this->version = $version;
        $this->apiBase = ($apiBase ?: self::SOAP_API_BASE) . '/api';
        $this->setWSDL($version);
        $this->setClient();
    }

    /**
     * Initialize the SoapClient
     * @param $client
     * @return $this
     */
    public function setClient($client=NULL)
    {
        if ($client) {
            $this->client = $client;
        } else {
            $options = array (
                'trace' => true
            );
            $this->client = new PHPSoapClient($this->getWSDL(), $options);
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
        $this->_setVersion($version);
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
        $listWorkOrderIds = $this->client->listWorkOrders($this->_getLogin(), $status);
        $response = array();
        foreach ($listWorkOrderIds as $id) {
            $wo = new WorkOrder($this);
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
        $wo = $this->client->getWorkOrder($this->_getLogin(), $workOrderId);
        $woObj = new WorkOrder($this);
        if ($wo) {
            $woObj->setGroup($wo->group ?: '')
                ->setAllowTechUploads((boolean)$wo->techUploads)
                ->setWillAlertWhenPublished((boolean)$wo->alertWhenPublished)
                ->setIsPrintable((boolean)$wo->printLink);
            
            $serviceDescriptionObj = new ServiceDescription();
            $serviceDescriptionObj->setCategoryId($wo->description->category)
                ->setTitle($wo->description->title)
                ->setDescription($wo->description->description)
                ->setInstruction($wo->description->instruction);
            $woObj->setDescription($serviceDescriptionObj);

            $serviceLocationObj = new ServiceLocation();
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

            $timeRangeObj = new TimeRange();
            $timeRangeObj->setTimeBegin(\DateTime::createFromFormat(\DateTime::ATOM, $wo->startTime->timeBegin, new \DateTimeZone('UTC')))
                ->setTimeEnd(\DateTime::createFromFormat(\DateTime::ATOM, $wo->startTime->timeEnd, new \DateTimeZone('UTC')));
            $woObj->setStartTime($timeRangeObj);

            $payInfoObj = new PayInfo();
            if ($wo->payInfo->perHour !== null) {
                $payFixed = new FixedPay();
                $payFixed->setAmount($wo->payInfo->fixed->amount);
                $payInfoObj->setFixed($payFixed);
            }
            if ($wo->payInfo->perHour !== null) {
                $payPreHour = new RatePay();
                $payPreHour->setRate($wo->payInfo->perHour->rate);
                $payPreHour->setMaxUnits($wo->payInfo->perHour->maxUnits);
                $payInfoObj->setPerDevice($payPreHour);
            }
            if ($wo->payInfo->perDevice !== null) {
                $payDevice = new RatePay();
                $payDevice->setRate($wo->payInfo->perDevice->rate);
                $payDevice->setMaxUnits($wo->payInfo->perDevice->maxUnits);
                $payInfoObj->setPerDevice($payDevice);
            }
            if ($wo->payInfo->blended !== null) {
                $payBlended = new BlendedPay();
                $payBlended->setBaseAmount($wo->payInfo->blended->baseAmount);
                $payBlended->setBaseHours($wo->payInfo->blended->baseHours);
                $payBlended->setAdditionalHourlyRate($wo->payInfo->blended->additionalHourlyRate);
                $payBlended->setMaxAdditionalHours($wo->payInfo->blended->maxAdditionalHours);
                $payInfoObj->setBlended($payBlended);
            }
            $woObj->setPayInfo($payInfoObj);

            $additionalFields = array();
            if (is_array($wo->additionalFields)) {
                foreach ($wo->additionalFields as $field) {
                    $additionalField = new AdditionalField();
                    $additionalField->setName($field->name);
                    if ($field->value !== null) {
                        $additionalField->setValue($field->name);
                    }
                    $additionalFields[] = $additionalField;
                }
                $woObj->setAdditionalFields($additionalFields);
            }

            $labels = array();
            if (is_array($wo->labels)) {
                foreach ($wo->labels as $label) {
                    $labelObj = new Label();
                    $labelObj->setId($label->labelId);
                    $labelObj->setName($label->labelName);
                    $labelObj->setHideFromTech((boolean)$label->hideFromTech);
                    $labelObj->setTechCanEdit((boolean)$label->techCanEdit);
                    $labels[] = $labelObj;
                }
                $woObj->setLabels($labels);
            }

            // TODO: array of CloseoutRequirement
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
        // TODO: Implement getWorkOrderStatus() method.
    }

    /**
     * Get the assigned provider
     *
     * @param $workOrderId
     * @return TechnicianInterface
     */
    public function getWorkOrderAssignedProvider($workOrderId)
    {
        // TODO: Implement getWorkOrderAssignedProvider() method.
    }

    /**
     * Get the progress of a workorder
     *
     * @param $workOrderId
     * @return ProgressInterface
     */
    public function getWorkOrderProgress($workOrderId)
    {
        // TODO: Implement getWorkOrderProgress() method.
    }

    /**
     * Get the payment details for a work order
     *
     * @param $workOrderId
     * @return PaymentInterface
     */
    public function getWorkOrderPayment($workOrderId)
    {
        // TODO: Implement getWorkOrderPayment() method.
    }

    /**
     * Get all of the messages for a work order
     *
     * @param $workOrderId
     * @return MessageInterface[]
     */
    public function getWorkOrderMessages($workOrderId)
    {
        // TODO: Implement getWorkOrderMessages() method.
    }

    /**
     * Get all of the attached documents for a work order
     *
     * @param $workOrderId
     * @return DocumentInterface[]
     */
    public function getWorkOrderAttachedDocuments($workOrderId)
    {
        // TODO: Implement getWorkOrderAttachedDocuments() method.
    }

    /**
     * Get all of the tracked shipments for a work order
     *
     * @param $workOrderId
     * @return ShipmentInterface[]
     */
    public function getWorkOrderShipments($workOrderId)
    {
        // TODO: Implement getWorkOrderShipments() method.
    }

    /**
     * Get all of the projects for your company
     *
     * @return ProjectInterface[]
     */
    public function getProjects()
    {
        // TODO: Implement getProjects() method.
    }

    /**
     * Get a project
     *
     * @param $projectId
     * @return ProjectInterface
     */
    public function getProject($projectId)
    {
        // TODO: Implement getProject() method.
    }

    /**
     * Convert a FN shipping id into a tracking number
     * @param $shippingId
     * @return TrackingToShipmentResultInterface
     */
    public function convertShippingIdToTrackingId($shippingId)
    {
        // TODO: Implement convertShippingIdToTrackingId() method.
    }

    /**
     * @param $shipmentId
     * @return ShipmentHistoryInterface
     */
    public function getShipmentHistory($shipmentId)
    {
        // TODO: Implement getShipmentHistory() method.
    }

    /**
     * Get all of the documents for your company.
     *
     * @return DocumentInterface[]
     */
    public function getDocuments()
    {
        // TODO: Implement getDocuments() method.
    }

    /**
     * Create a work order.
     *
     * @param WorkOrderInterface $wo
     * @param $useTemplate
     * @return ResultInterface
     */
    public function createWorkOrder(WorkOrderInterface $wo, $useTemplate)
    {
        // TODO: Implement createWorkOrder() method.
    }

    /**
     * Publish a work order.
     *
     * @param $workOrderId
     * @return ResultInterface
     */
    public function publishWorkOrder($workOrderId)
    {
        // TODO: Implement publishWorkOrder() method.
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
        // TODO: Implement routeWorkOrderToGroup() method.
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
        // TODO: Implement routeWorkOrderToProvider() method.
    }

    /**
     * Mark a work order as approved.
     *
     * @param $workOrderId
     * @return ResultInterface
     */
    public function approveWorkOrder($workOrderId)
    {
        // TODO: Implement approveWorkOrder() method.
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
        // TODO: Implement cancelWorkOrder() method.
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
        // TODO: Implement attachDocumentToWorkOrder() method.
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
        // TODO: Implement detachDocumentFromWorkOrder() method.
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
        // TODO: Implement addMessageToWorkOrder() method.
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
        // TODO: Implement setCustomFieldOnWorkOrder() method.
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
        // TODO: Implement setLabelOnWorkOrder() method.
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
        // TODO: Implement unsetLabelOnWorkOrder() method.
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
        // TODO: Implement satisfyCloseoutOnWorkOrder() method.
    }

    /**
     * Delete a Field Nation shipment from a work order
     *
     * @param $shipmentId
     * @return ResultInterface
     */
    public function deleteShipment($shipmentId)
    {
        // TODO: Implement deleteShipment() method.
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
        // TODO: Implement addShipment() method.
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
        // TODO: Implement updateWorkOrderSchedule() method.
    }

    /**
     * set the version
     *
     * @param $version
     * @return void
     */
    private function _setVersion($version)
    {
        $this->version = !ctype_alpha($version[0]) ? 'v'.$version : $version;
    }

    /**
     * return the login credentials to use for api call
     *
     * @param $version
     * @return stdClass
     */
    private function _getLogin() {
        $login = new \stdClass();
        $login->customerID = $this->credentials->getCustomerId();
        $login->apiKey = $this->credentials->getApiKey();
        $login->effectiveUser = $this->credentials->getEffectiveUser();
        return $login;
    }
}