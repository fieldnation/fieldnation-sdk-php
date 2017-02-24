<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface WorkLogInterface
{
    /**
     * Set the date and time the work started.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTimeBegin($time);

    /**
     * Get the date and time the work started.
     *
     * @return \DateTime
     */
    public function getTimeBegin();

    /**
     * Set the date and time the work stopped.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTimeEnd($time);

    /**
     * Get the date and time the work stopped.
     *
     * @return \DateTime
     */
    public function getTimeEnd();

    /**
     * Set the amount of hours worked
     *
     * @param float $hours
     * @return self
     */
    public function setHours($hours);

    /**
     * Get the amount of hours worked
     *
     * @return float
     */
    public function getHours();

    /**
     * Set the quantity of devices fixed
     *
     * @param integer $devices
     * @return self
     */
    public function setDevices($devices);

    /**
     * Get the quantity of devices fixed
     *
     * @return integer
     */
    public function getDevices();

    /**
     * Set if the provider enters check in data.
     *
     * @param CheckInOutInterface $checkIn
     * @return self
     */
    public function setCheckInInfo(CheckInOutInterface $checkIn);

    /**
     * Get if the provider enters check in data.
     *
     * @return CheckInOutInterface
     */
    public function getCheckInInfo();

    /**
     * Set if the provider enters check out data.
     *
     * @param CheckInOutInterface $checkIn
     * @return self
     */
    public function setCheckOutInfo(CheckInOutInterface $checkIn);

    /**
     * Get if the provider enters check out data.
     *
     * @return CheckInOutInterface
     */
    public function getCheckOutInfo();
}