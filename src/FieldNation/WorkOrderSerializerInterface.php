<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


/**
 * Interface WorkOrderSerializerInterface
 * @package FieldNation
 */
interface WorkOrderSerializerInterface
{
    /**
     * Get the name of the project the work order should be a member of.
     *
     * If not present, the work order will not belong to a project (default behavior).
     * If the project does not already exist, it will be created automatically and your effectiveUser
     * (See Login structure) will be the default manager for all newly-created projects.
     *
     * @return string
     */
    public function getGroup();

    /**
     * Get the general descriptive information relevant to the job.
     *
     * @return ServiceDescriptionInterface
     */
    public function getDescription();

    /**
     * Get where the job site is located.
     *
     * @return ServiceLocationInterface
     */
    public function getLocation();

    /**
     * Get scheduling information for the Work Order, including any applicable end time.
     *
     * @return TimeRangeInterface
     */
    public function getStartTime();

    /**
     * Get payment details to be advertised on the Work Order.
     * @return PayInfoInterface
     */
    public function getPayInfo();

    /**
     * Get whether to allow the technician to upload files to the Work Order.
     * If enabled, this Work Order will inherit required items from the project
     * it belongs to or settings your company has configured for all Work Orders.
     *
     * @return boolean
     */
    public function getAllowTechUploads();

    /**
     * Get whether to email any providers about the Work Order.
     * Typical usage is true and should only be disabled in certain circumstances.
     *
     * @return boolean
     */
    public function getWillAlertWhenPublished();

    /**
     * Get whether to grant technician access to a print-friendly version of work order details.
     * It is strongly recommended this is set to true. This should only be set false
     * if you will be attaching a printable version as a document.
     *
     * @return boolean
     */
    public function getIsPrintable();

    /**
     * Get additional fields (custom fields) and values provided by your company for the Work Order.
     *
     * @return AdditionalFieldInterface[]
     */
    public function getAdditionalFields();

    /**
     * Get labels that are set on the work order.
     *
     * @return string[]
     */
    public function getLabels();

    /**
     * Get a list of requirements to be met before the Work Order is able to be marked Work Done.
     * Currently only configured and satisfied via the API. Should be NULL if not configured.
     *
     * @return array|NULL
     */
    public function getCloseoutRequirements();
}