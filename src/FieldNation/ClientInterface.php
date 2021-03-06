<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ClientInterface
{
    /**
     * ClientInterface constructor.
     * @param SDKCredentialsInterface $credentials
     * @param null $version - The version the client should use. Not all client may support this.
     * @param null $apiBase - base api location ex. https://api.fieldnation.com
     */
    public function __construct(
        SDKCredentialsInterface $credentials,
        ClassMapFactoryInterface $classMapFactory,
        $version = null,
        $apiBase = null
    );
    
    /**
     * Get all work orders by status
     *
     * @param $status
     * @return WorkOrderInterface[]
     */
    public function getWorkOrders($status);

    /**
     * Get a work order
     *
     * @param $workOrderId
     * @return WorkOrderInterface
     */
    public function getWorkOrder($workOrderId);

    /**
     * Get the status of a work order
     *
     * @param $workOrderId
     * @return string
     */
    public function getWorkOrderStatus($workOrderId);

    /**
     * Get the assigned provider
     *
     * @param $workOrderId
     * @return TechnicianInterface
     */
    public function getWorkOrderAssignedProvider($workOrderId);

    /**
     * Get the progress of a workorder
     *
     * @param $workOrderId
     * @param $providerId
     * @return ProgressInterface
     */
    public function getWorkOrderProgress($workOrderId, $providerId);

    /**
     * Get the payment details for a work order
     *
     * @param $workOrderId
     * @return PaymentInterface
     */
    public function getWorkOrderPayment($workOrderId);

    /**
     * Get all of the messages for a work order
     *
     * @param $workOrderId
     * @return MessageInterface[]
     */
    public function getWorkOrderMessages($workOrderId);

    /**
     * Get all of the attached documents for a work order
     *
     * @param $workOrderId
     * @return DocumentInterface[]
     */
    public function getWorkOrderAttachedDocuments($workOrderId);

    /**
     * Get all of the tracked shipments for a work order
     *
     * @param $workOrderId
     * @return ShipmentInterface[]
     */
    public function getWorkOrderShipments($workOrderId);

    /**
     * Get all of the projects for your company
     *
     * @return ProjectInterface[]
     */
    public function getProjects();

    /**
     * Get a project
     *
     * @param $projectId
     * @return ProjectInterface
     */
    public function getProject($projectId);

    /**
     * Convert a tracking number into FN shipping id
     * @param $trackingId
     * @return TrackingToShipmentResultInterface
     */
    public function convertTrackingIdToShippingId($trackingId);

    /**
     * @param $shipmentId
     * @return ShipmentHistoryInterface
     */
    public function getShipmentHistory($shipmentId);

    /**
     * Get all of the documents for your company.
     *
     * @return DocumentInterface[]
     */
    public function getDocuments();

    /**
     * Create a work order.
     *
     * @param WorkOrderInterface $wo
     * @param $useTemplate
     * @return ResultInterface
     */
    public function createWorkOrder(WorkOrderSerializerInterface $wo, $useTemplate);

    /**
     * Publish a work order.
     *
     * @param $workOrderId
     * @return ResultInterface
     */
    public function publishWorkOrder($workOrderId);

    /**
     * Route a work order.
     *
     * @param $workOrderId
     * @param $groupId
     * @return ResultInterface
     */
    public function routeWorkOrderToGroup($workOrderId, $groupId);

    /**
     * Route a work order.
     *
     * @param $workOrderId
     * @param $providerId
     * @return ResultInterface
     */
    public function routeWorkOrderToProvider($workOrderId, $providerId);

    /**
     * Mark a work order as approved.
     *
     * @param $workOrderId
     * @return ResultInterface
     */
    public function approveWorkOrder($workOrderId);

    /**
     * Cancel a work order.
     *
     * @param $workOrderId
     * @param $willAcceptFees
     * @param $revertRequestReason
     * @return ResultInterface
     */
    public function cancelWorkOrder($workOrderId, $willAcceptFees, $revertRequestReason);

    /**
     * Attach a document to a work order.
     *
     * @param $workOrderId
     * @param $documentId
     * @return ResultInterface
     */
    public function attachDocumentToWorkOrder($workOrderId, $documentId);

    /**
     * Detach a document from a work order.
     *
     * @param $workOrderId
     * @param $documentId
     * @return ResultInterface
     */
    public function detachDocumentFromWorkOrder($workOrderId, $documentId);

    /**
     * Add a message to a work order.
     *
     * @param $workOrderId
     * @param $messageText
     * @param $messageMode 1 = Internal Note, 2 = Assigned Tech, 3 = Requesting providers, 4 = Routed to providers
     * @return ResultInterface
     */
    public function addMessageToWorkOrder($workOrderId, $messageText, $messageMode);

    /**
     * Set a custom field on a work order
     *
     * @param $workOrderId
     * @param $fieldName
     * @param $fieldValue
     * @return ResultInterface
     */
    public function setCustomFieldOnWorkOrder($workOrderId, $fieldName, $fieldValue);

    /**
     * Set a label on a work order
     *
     * @param $workOrderId
     * @param $labelName
     * @return ResultInterface
     */
    public function setLabelOnWorkOrder($workOrderId, $labelName);

    /**
     * Unset a label on a work order
     *
     * @param $workOrderId
     * @param $labelName
     * @return ResultInterface
     */
    public function unsetLabelOnWorkOrder($workOrderId, $labelName);

    /**
     * Mark a closeout requirement as completed
     *
     * @param $workOrderId
     * @param $closeoutName
     * @return ResultInterface
     */
    public function satisfyCloseoutOnWorkOrder($workOrderId, $closeoutName);

    /**
     * Delete a Field Nation shipment from a work order
     *
     * @param $shipmentId
     * @return string
     */
    public function deleteShipment($shipmentId);

    /**
     * Add a shipment to Field Nation
     *
     * @param $workOrderId
     * @param ShipmentInterface $shipment
     * @return string
     */
    public function addShipment($workOrderId, ShipmentInterface $shipment);

    /**
     * Update the schedule for a work order
     *
     * @param $workOrderId
     * @param TimeRangeInterface $range
     * @return ResultInterface
     */
    public function updateWorkOrderSchedule($workOrderId, TimeRangeInterface $range);

    /**
     * Set the class map factory that can create the classes needed for the client's return types
     *
     * @param ClassMapFactoryInterface $factory
     * @return self
     */
    public function setClassMapFactory(ClassMapFactoryInterface $factory);
}
