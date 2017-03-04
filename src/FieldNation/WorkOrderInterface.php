<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface WorkOrderInterface extends IdentifiableInterface, WorkOrderSerializerInterface
{
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
    public function setGroup($group);

    /**
     * Set the general descriptive information relevant to the job.
     *
     * @param ServiceDescriptionInterface $description
     * @return self
     */
    public function setDescription(ServiceDescriptionInterface $description);

    /**
     * Set where the job site is located.
     *
     * @param ServiceLocationInterface $location
     * @return self
     */
    public function setLocation(ServiceLocationInterface $location);

    /**
     * Set scheduling information for the Work Order, including any applicable end time.
     *
     * @param TimeRangeInterface $timeRange
     * @return self
     */
    public function setStartTime(TimeRangeInterface $timeRange);

    /**
     * Set payment details to be advertised on the Work Order.
     * @param PayInfoInterface $payInfo
     * @return self
     */
    public function setPayInfo(PayInfoInterface $payInfo);

    /**
     * Set whether to allow the technician to upload files to the Work Order.
     * If enabled, this Work Order will inherit required items from the project
     * it belongs to or settings your company has configured for all Work Orders.
     *
     * @param boolean $areAllowed
     * @return self
     */
    public function setAllowTechUploads($areAllowed);

    /**
     * Set whether to email any providers about the Work Order.
     * Typical usage is true and should only be disabled in certain circumstances.
     *
     * @param boolean $willAlert
     * @return self
     */
    public function setWillAlertWhenPublished($willAlert);

    /**
     * Set whether to grant technician access to a print-friendly version of work order details.
     * It is strongly recommended this is set to true. This should only be set false
     * if you will be attaching a printable version as a document.
     *
     * @param boolean $isPrintable
     * @return self
     */
    public function setIsPrintable($isPrintable);

    /**
     * Set additional fields (custom fields) and values provided by your company for the Work Order.
     *
     * @param array $fields
     * @return self
     */
    public function setAdditionalFields($fields);

    /**
     * Set labels that are set on the work order.
     * TODO: this is currently ignored during creation of a Work Order,
     *       and you need to call setLabelOnWorkorder after creation to set labels on new Work Orders.
     *
     * @param array $labels
     * @return self
     */
    public function setLabels($labels);

    /**
     * A list of requirements to be met before the Work Order is able to be marked Work Done.
     * Currently only configured and satisfied via the API. Should be NULL if not configured.
     *
     * @param array $requirements
     * @return self
     */
    public function setCloseoutRequirements($requirements);

    /**
     * Occasionally it is beneficial to get everything about a work order.
     * @return WorkOrderInterface
     */
    public function get();

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
    public function getStatus();

    /**
     * Want to know who is arriving on-site? We thought so.
     *
     * @return TechnicianInterface
     */
    public function getAssignedProvider();

    /**
     * Why not figure out how far along a Work Order is?
     *
     * @return ProgressInterface
     */
    public function getProgress();

    /**
     * Want to know what a Work Order will cost to approve? This is how you find out.
     *
     * @return PaymentInterface
     */
    public function getPayment();

    /**
     * Want to see if a message has been posted? This would be the best way to do so.
     *
     * @return MessageInterface[]
     */
    public function getMessages();

    /**
     * This method will tell you what is currently attached, so you can make any revisions necessary.
     *
     * @return DocumentInterface[]
     */
    public function getAttachedDocuments();

    /**
     * Want to see the shipments for a Work Order? This is how you find them.
     *
     * @return ShipmentInterface[]
     */
    public function getShipments();

    /**
     * The most common use of the Field Nation's SDK is to create a Work Order. Here's how!
     *
     * @return ResultInterface
     */
    public function create();

    /**
     * Ready to publish your work order? Here's how!
     *
     * @return ResultInterface
     */
    public function publish();

    /**
     * Want to route a work order to a provider? Here's how!
     *
     * @param RecipientInterface $recipient
     * @return ResultInterface
     */
    public function routeTo(RecipientInterface $recipient);

    /**
     * Approving a Work Order is the last step for your company. Here's how you do it!
     *
     * @return ResultInterface
     */
    public function approve();

    /**
     * If things did not go as planned, and you just want to cancel and start again, here's how.
     *
     * @param boolean $willAcceptFees      Mark if you will accept cancellation fees or not
     * @param string $revertRequestReason  Optionally provide a reason you will revert the request after accepting fees.
     * @return ResultInterface
     */
    public function cancel($willAcceptFees, $revertRequestReason = null);

    /**
     * After creating a Work Order, you can attach any existing documents you want to. Here's how!
     *
     * @param DocumentInterface $document
     * @return ResultInterface
     */
    public function attach(DocumentInterface $document);

    /**
     * If a document is no longer needed on a Work Order, why not detach it to keep everything clear?
     *
     * @param DocumentInterface $document
     * @return ResultInterface
     */
    public function detach(DocumentInterface $document);

    /**
     * Adding a message on a Work Order can go a long way. Here's how.
     *
     * @param MessageInterface $message
     * @return ResultInterface
     */
    public function addMessage(MessageInterface $message);

    /**
     * Work Orders belong to you. Make them yours by adding a custom field.
     *
     * @param AdditionalFieldInterface $field
     * @return ResultInterface
     */
    public function addAdditionalField(AdditionalFieldInterface $field);

    /**
     * Add a label to your Work Order.
     * NOTE: The label must already exist for your company.
     *
     * @param $labelName
     * @return ResultInterface
     */
    public function addLabel($labelName);

    /**
     * Remove a label from your Work Order.
     *
     * @param $labelName
     * @return ResultInterface
     */
    public function removeLabel($labelName);

    /**
     * Mark a close out requirement as resolved.
     *
     * @param $name
     * @return ResultInterface
     */
    public function satisfyCloseoutRequest($name);

    /**
     * If a tracking number expired before it was shipped, delete if from Field Nation to keep everything clean!
     *
     * @param ShipmentInterface $shipment
     * @return ResultInterface
     */
    public function deleteShipment(ShipmentInterface $shipment);

    /**
     * Add a Shipment on a Work Order for Field Nation to track.
     *
     * @param ShipmentInterface $shipment
     * @return ResultInterface
     */
    public function addShipment(ShipmentInterface $shipment);

    /**
     * Maybe your schedule changed? Be sure to update the Work Order!
     *
     * @param TimeRangeInterface $schedule
     * @return ResultInterface
     */
    public function updateSchedule(TimeRangeInterface $schedule);
}
