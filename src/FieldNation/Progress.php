<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Progress implements ProgressInterface
{
    private $totalDevices;
    private $totalHours;
    private $loggedWork;
    private $uploads;
    private $workData;
    private $closingNotes;
    private $assignmentConfirmed;
    private $readyToGo;
    private $workSchedule;

    /**
     * Set the number of devices a provider has indicated to have completed on the work order.
     *
     * @param integer $deviceCount
     * @return self
     */
    public function setTotalDevices($deviceCount)
    {
        $this->totalDevices = (integer)$deviceCount;
        return $this;
    }

    /**
     * Get the number of devices a provider has indicated to have completed on the work order.
     *
     * @return integer
     */
    public function getTotalDevices()
    {
        return $this->totalDevices;
    }

    /**
     * Set the summation of hours a provider has indicated to have spent on the work order.
     *
     * @param float $hours
     * @return self
     */
    public function setTotalHours($hours)
    {
        $this->totalHours = (float)$hours;
        return $this;
    }

    /**
     * Get the summation of hours a provider has indicated to have spent on the work order.
     *
     * @return float
     */
    public function getTotalHours()
    {
        return $this->totalHours;
    }

    /**
     * Set the breakdown of the time(s) the provider has logged.
     *
     * @param WorkLogInterface[] $loggedWork
     * @return self
     */
    public function setLoggedWork($loggedWork)
    {
        $this->loggedWork = $loggedWork;
        return $this;
    }

    /**
     * Get the breakdown of the time(s) the provider has logged.
     * @return WorkLogInterface[]
     */
    public function getLoggedWork()
    {
        return $this->loggedWork;
    }

    /**
     * Set the uploads to the work order progress.
     *
     * @param TechUploadInterface[] $uploads
     * @return self
     */
    public function setUploads($uploads)
    {
        $this->uploads = $uploads;
        return $this;
    }

    /**
     * Get the uploads to the work order progress.
     *
     * @return TechUploadInterface[]
     */
    public function getUploads()
    {
        return $this->uploads;
    }

    /**
     * Set the data your company has configured on the work order.
     *
     * @param AdditionalFieldInterface[] $data
     * @return self
     */
    public function setWorkData($data)
    {
        $this->workData = $data;
        return $this;
    }

    /**
     * Get the data your company has configured on the work order.
     *
     * @return AdditionalFieldInterface[]
     */
    public function getWorkData()
    {
        return $this->workData;
    }

    /**
     * Set the final closing notes to be entered by the provider.
     *
     * @param string $closingNotes
     * @return self
     */
    public function setClosingNotes($closingNotes)
    {
        $this->closingNotes = $closingNotes;
        return $this;
    }

    /**
     * Get the final closing notes that were entered by the provider.
     *
     * @return string
     */
    public function getClosingNotes()
    {
        $this->closingNotes;
        return $this;
    }

    /**
     * Set whether the provider confirmed their assignment.
     *
     * @param boolean $isConfirmed
     * @return self
     */
    public function setIsAssignmentConfirmed($isConfirmed)
    {
        $this->assignmentConfirmed = (boolean)$isConfirmed;
        return $this;
    }

    /**
     * Get whether the provider confirmed their assignment.
     *
     * @return boolean
     */
    public function getIsAssignmentConfirmed()
    {
        return $this->assignmentConfirmed;
    }

    /**
     * Set whether the provider has indicated ready-to-go status.
     *
     * @param boolean $isReady
     * @return self
     */
    public function setIsReadyToGo($isReady)
    {
        $this->readyToGo = (boolean)$isReady;
        return $this;
    }

    /**
     * Get whether the provider has indicated ready-to-go status.
     *
     * @return boolean
     */
    public function getIsReadyToGo()
    {
        return $this->readyToGo;
    }

    /**
     * Set the schedule the provider indicated to complete the work order.
     *
     * @param TimeRangeInterface[] $workSchedule
     * @return self
     */
    public function setWorkSchedule($workSchedule)
    {
        $this->workSchedule = $workSchedule;
        return $this;
    }

    /**
     * Get the schedule the provider indicated to complete the work order.
     * @return TimeRangeInterface[]
     */
    public function getWorkSchedule()
    {
        return $this->workSchedule;
    }
}
