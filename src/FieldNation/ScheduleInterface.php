<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface ScheduleInterface
{
    /**
     * Set the start time.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setStartTime($time);

    /**
     * Get the start time.
     *
     * @return \DateTime
     */
    public function getStartTime();

    /**
     * Set the end time.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setEndTime($time);

    /**
     * Get the end time.
     *
     * @return \DateTime
     */
    public function getEndTime();
}