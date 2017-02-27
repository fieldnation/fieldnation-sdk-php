<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class WorkLog implements WorkLogInterface
{
    private $timeBegin;
    private $timeEnd;
    private $hours;
    private $devices;
    private $checkInInfo;
    private $checkOutInfo;

    /**
     * Set the date and time the work started.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTimeBegin($time) {
        $this->timeBegin = $time;
        return $this;
    }

    /**
     * Get the date and time the work started.
     *
     * @return \DateTime
     */
    public function getTimeBegin() {
        return $this->timeEnd;
    }

    /**
     * Set the date and time the work stopped.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTimeEnd($time) {
        $this->timeEnd = $time;
        return $this;
    }

    /**
     * Get the date and time the work stopped.
     *
     * @return \DateTime
     */
    public function getTimeEnd() {
        return $this->timeEnd;
    }

    /**
     * Set the amount of hours worked
     *
     * @param float $hours
     * @return self
     */
    public function setHours($hours) {
        $this->hours = (float)$hours;
        return $this;
    }

    /**
     * Get the amount of hours worked
     *
     * @return float
     */
    public function getHours() {
        return $this->hours;
    }

    /**
     * Set the quantity of devices fixed
     *
     * @param integer $devices
     * @return self
     */
    public function setDevices($devices) {
        $this->devices = (integer)$devices;
        return $this;
    }

    /**
     * Get the quantity of devices fixed
     *
     * @return integer
     */
    public function getDevices() {
        return $this->devices;
    }

    /**
     * Set if the provider enters check in data.
     *
     * @param CheckInOutInterface $checkIn
     * @return self
     */
    public function setCheckInInfo(CheckInOutInterface $checkIn) {
        $this->checkInInfo = $checkIn;
        return $this;
    }

    /**
     * Get if the provider enters check in data.
     *
     * @return CheckInOutInterface
     */
    public function getCheckInInfo() {
        return $this->checkInInfo;
    }

    /**
     * Set if the provider enters check out data.
     *
     * @param CheckInOutInterface $checkOut
     * @return self
     */
    public function setCheckOutInfo(CheckInOutInterface $checkOut) {
        $this->checkOutInfo = $checkOut;
        return $this;
    }

    /**
     * Get if the provider enters check out data.
     *
     * @return CheckInOutInterface
     */
    public function getCheckOutInfo() {
        return $this->checkOutInfo;
    }
}