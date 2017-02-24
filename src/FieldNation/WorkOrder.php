<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class WorkOrder implements WorkOrderInterface
{
    private $id;
    private $client;
    private $group;
    private $description;
    private $location;
    private $startTime;
    private $payInfo;
    private $allowTechUploads;
    private $willAlertWhenPublished;
    private $isPrintable;
    private $additionalFields;
    private $labels;
    private $closeoutRequirements;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Set the name of the project the work order should be a member of.
     *
     * If not present, the work order will not belong to a project (default behavior).
     * If the project does not already exist, it will be created automatically and your effectiveUser
     * (See Login structure) will be the default manager for all newly-created projects.
     *
     * @param string $group
     * @return self
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Set the general descriptive information relevant to the job.
     *
     * @param ServiceDescriptionInterface $description
     * @return self
     */
    public function setDescription(ServiceDescriptionInterface $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set where the job site is located.
     *
     * @param ServiceLocationInterface $location
     * @return self
     */
    public function setLocation(ServiceLocationInterface $location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Set scheduling information for the Work Order, including any applicable end time.
     *
     * @param TimeRangeInterface $timeRange
     * @return self
     */
    public function setStartTime(TimeRangeInterface $timeRange)
    {
        $this->startTime = $timeRange;
        return $this;
    }

    /**
     * Set payment details to be advertised on the Work Order.
     * @param PayInfoInterface $payInfo
     * @return self
     */
    public function setPayInfo(PayInfoInterface $payInfo)
    {
        $this->payInfo = $payInfo;
        return $this;
    }

    /**
     * Set whether to allow the technician to upload files to the Work Order.
     * If enabled, this Work Order will inherit required items from the project
     * it belongs to or settings your company has configured for all Work Orders.
     *
     * @param boolean $areAllowed
     * @return self
     */
    public function setAllowTechUploads($areAllowed)
    {
        $this->allowTechUploads = $areAllowed;
        return $this;
    }

    /**
     * Set whether to email any providers about the Work Order.
     * Typical usage is true and should only be disabled in certain circumstances.
     *
     * @param boolean $willAlert
     * @return self
     */
    public function setWillAlertWhenPublished($willAlert)
    {
        $this->willAlertWhenPublished = $willAlert;
        return $this;
    }

    /**
     * Set whether to grant technician access to a print-friendly version of work order details.
     * It is strongly recommended this is set to true. This should only be set false
     * if you will be attaching a printable version as a document.
     *
     * @param boolean $isPrintable
     * @return self
     */
    public function setIsPrintable($isPrintable)
    {
        $this->isPrintable;
        return $this;
    }

    /**
     * Set additional fields (custom fields) and values provided by your company for the Work Order.
     *
     * @param array $fields
     * @return self
     */
    public function setAdditionalFields($fields)
    {
        $this->additionalFields = $fields;
        return $this;
    }

    /**
     * Set labels that are set on the work order.
     * TODO: this is currently ignored during creation of a Work Order, and you need to call setLabelOnWorkorder after creation to set labels on new Work Orders.
     *
     * @param array $labels
     * @return self
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;
        return $this;
    }

    /**
     * A list of requirements to be met before the Work Order is able to be marked Work Done.
     * Currently only configured and satisfied via the API. Should be NULL if not configured.
     *
     * @param array $requirements
     * @return self
     */
    public function setCloseoutRequirements($requirements)
    {
        $this->closeoutRequirements = $requirements;
        return $this;
    }

    /**
     * Occasionally it is beneficial to get everything about a work order.
     * @return WorkOrderInterface
     */
    public function get()
    {
        return $this->client->getWorkOrder($this->getId());
    }

    /**
     * Get the status of a work order
     *
     * Possible return values for this method:
     *      "Created",
     *      "Published",
     *      "Routed",
     *      "Assigned",
     *      "Work Done",
     *      "Approved",
     *      "Paid",
     *      "Cancelled"
     * @return string
     */
    public function getStatus()
    {
        return $this->client->getWorkOrderStatus($this->getId());
    }

    /**
     * Want to know who is arriving on-site? We thought so.
     *
     * @return TechnicianInterface
     */
    public function getAssignedProvider()
    {
        return $this->client->getWorkOrderAssignedProvider($this->getId());
    }

    /**
     * Why not figure out how far along a Work Order is?
     *
     * @return ProgressInterface
     */
    public function getProgress()
    {
        return $this->client->getWorkOrderProgress($this->getId());
    }

    /**
     * Want to know what a Work Order will cost to approve? This is how you find out.
     *
     * @return PaymentInterface
     */
    public function getPayment()
    {
        return $this->client->getWorkOrderPayment($this->getId());
    }

    /**
     * Want to see if a message has been posted? This would be the best way to do so.
     *
     * @return MessageInterface[]
     */
    public function getMessages()
    {
        return $this->client->getWorkOrderMessages($this->getId());
    }

    /**
     * This method will tell you what is currently attached, so you can make any revisions necessary.
     *
     * @return DocumentInterface[]
     */
    public function getAttachedDocuments()
    {
        return $this->client->getWorkOrderAttachedDocuments($this->getId());
    }

    /**
     * Want to see the shipments for a Work Order? This is how you find them.
     *
     * @return ShipmentInterface[]
     */
    public function getShipments()
    {
        return $this->client->getWorkOrderShipments($this->getId());
    }

    /**
     * The most common use of the Field Nation's SDK is to create a Work Order. Here's how!
     *
     * @return ResultInterface
     */
    public function create()
    {
        return $this->client->createWorkOrder($this, false);
    }

    /**
     * Ready to publish your work order? Here's how!
     *
     * @return ResultInterface
     */
    public function publish()
    {
        return $this->client->publishWorkOrder($this->getId());
    }

    /**
     * Want to route a work order to a provider? Here's how!
     *
     * @param RecipientInterface $recipient
     * @return ResultInterface
     */
    public function routeTo(RecipientInterface $recipient)
    {
        if ($recipient->isGroup()) {
            return $this->client->routeWorkOrderToGroup($this->getId(), $recipient->getId());
        } else if ($recipient->isProvider()) {
            return $this->client->routeWorkOrderToProvider($this->getId(), $recipient->getId());
        }

        // Don't know how else to respond -- Failure!
        $result = new FailureResult();
        $result->setMessage('The work order routing recipient is unrecognized.')
               ->setWorkOrderId($this->getId());

        return $result;
    }

    /**
     * Approving a Work Order is the last step for your company. Here's how you do it!
     *
     * @return ResultInterface
     */
    public function approve()
    {
        return $this->client->approveWorkOrder($this->getId());
    }

    /**
     * If things did not go as planned, and you just want to cancel and start again, here's how.
     *
     * @return ResultInterface
     */
    public function cancel($willAcceptFees, $reason=NULL)
    {
        return $this->client->cancelWorkOrder($this->getId(), $willAcceptFees, $reason);
    }

    /**
     * After creating a Work Order, you can attach any existing documents you want to. Here's how!
     *
     * @param DocumentInterface $document
     * @return ResultInterface
     */
    public function attach(DocumentInterface $document)
    {
        return $this->client->attachDocumentToWorkOrder($this->getId(), $document->getId());
    }

    /**
     * If a document is no longer needed on a Work Order, why not detach it to keep everything clear?
     *
     * @param DocumentInterface $document
     * @return ResultInterface
     */
    public function detach(DocumentInterface $document)
    {
        return $this->client->detachDocumentFromWorkOrder($this->getId(), $document->getId());
    }

    /**
     * Adding a message on a Work Order can go a long way. Here's how.
     *
     * @param MessageInterface $message
     * @return ResultInterface
     */
    public function addMessage(MessageInterface $message)
    {
        return $this->client->addMessageToWorkOrder($this->getId(), $message->getMessage(), $message->getMode());
    }

    /**
     * Work Orders belong to you. Make them yours by adding a custom field.
     *
     * @param AdditionalFieldInterface $field
     * @return ResultInterface
     */
    public function addAdditionalField(AdditionalFieldInterface $field)
    {
        return $this->client->setCustomFieldOnWorkOrder($this->getId(), $field->getName(), $field->getValue());
    }

    /**
     * Add a label to your Work Order.
     * NOTE: The label must already exist for your company.
     *
     * @param $labelName
     * @return ResultInterface
     */
    public function addLabel($labelName)
    {
        return $this->client->setLabelOnWorkOrder($this->getId(), $labelName);
    }

    /**
     * Remove a label from your Work Order.
     *
     * @param $labelName
     * @return ResultInterface
     */
    public function removeLabel($labelName)
    {
        return $this->client->unsetLabelOnWorkOrder($this->getId(), $labelName);
    }

    /**
     * Mark a close out requirement as resolved.
     *
     * @param $name
     * @return ResultInterface
     */
    public function satisfyCloseoutRequest($name)
    {
        return $this->client->satisfyCloseoutOnWorkOrder($this->getId(), $name);
    }

    /**
     * If a tracking number expired before it was shipped, delete if from Field Nation to keep everything clean!
     *
     * @param ShipmentInterface $shipment
     * @return ResultInterface
     */
    public function deleteShipment(ShipmentInterface $shipment)
    {
        return $this->client->deleteShipment($shipment->getId());
    }

    /**
     * Add a Shipment on a Work Order for Field Nation to track.
     *
     * @param ShipmentInterface $shipment
     * @return ResultInterface
     */
    public function addShipment(ShipmentInterface $shipment)
    {
        return $this->client->addShipment($this->getId(), $shipment);
    }

    /**
     * Maybe your schedule changed? Be sure to update the Work Order!
     *
     * @param ScheduleInterface $schedule
     * @return ResultInterface
     */
    public function updateSchedule(ScheduleInterface $schedule)
    {
        return $this->client->updateWorkOrderSchedule($this->getId(), $schedule);
    }

    /**
     * Set the id
     *
     * @param integer $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}