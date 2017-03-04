<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ProgressInterface
{
    /**
     * Set the number of devices a provider has indicated to have completed on the work order.
     *
     * @param integer $deviceCount
     * @return self
     */
    public function setTotalDevices($deviceCount);

    /**
     * Get the number of devices a provider has indicated to have completed on the work order.
     *
     * @return integer
     */
    public function getTotalDevices();

    /**
     * Set the summation of hours a provider has indicated to have spent on the work order.
     *
     * @param float $hours
     * @return self
     */
    public function setTotalHours($hours);

    /**
     * Get the summation of hours a provider has indicated to have spent on the work order.
     *
     * @return float
     */
    public function getTotalHours();

    /**
     * Set the breakdown of the time(s) the provider has logged.
     *
     * @param WorkLogInterface[] $loggedWork
     * @return self
     */
    public function setLoggedWork($loggedWork);

    /**
     * Get the breakdown of the time(s) the provider has logged.
     * @return WorkLogInterface[]
     */
    public function getLoggedWork();

    /**
     * Set the uploads to the work order progress.
     *
     * @param TechUploadInterface[] $uploads
     * @return self
     */
    public function setUploads($uploads);

    /**
     * Get the uploads to the work order progress.
     *
     * @return TechUploadInterface[]
     */
    public function getUploads();

    /**
     * Set the data your company has configured on the work order.
     *
     * @param AdditionalFieldInterface[] $data
     * @return self
     */
    public function setWorkData($data);

    /**
     * Get the data your company has configured on the work order.
     *
     * @return AdditionalFieldInterface[]
     */
    public function getWorkData();

    /**
     * Set the final closing notes to be entered by the provider.
     *
     * @param string $closingNotes
     * @return self
     */
    public function setClosingNotes($closingNotes);

    /**
     * Get the final closing notes that were entered by the provider.
     *
     * @return string
     */
    public function getClosingNotes();

    /**
     * Set whether the provider confirmed their assignment.
     *
     * @param boolean $isConfirmed
     * @return self
     */
    public function setIsAssignmentConfirmed($isConfirmed);

    /**
     * Get whether the provider confirmed their assignment.
     *
     * @return boolean
     */
    public function getIsAssignmentConfirmed();

    /**
     * Set whether the provider has indicated ready-to-go status.
     *
     * @param boolean $isReady
     * @return self
     */
    public function setIsReadyToGo($isReady);

    /**
     * Get whether the provider has indicated ready-to-go status.
     *
     * @return boolean
     */
    public function getIsReadyToGo();

    /**
     * Set the schedule the provider indicated to complete the work order.
     *
     * @param TimeRangeInterface[] $workSchedule
     * @return self
     */
    public function setWorkSchedule($workSchedule);

    /**
     * Get the schedule the provider indicated to complete the work order.
     * @return TimeRangeInterface[]
     */
    public function getWorkSchedule();
}
