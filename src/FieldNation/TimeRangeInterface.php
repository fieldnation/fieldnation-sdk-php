<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface TimeRangeInterface
{
    /**
     * Set the starting date and time.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTimeBegin($time);

    /**
     * Get the starting date and time.
     *
     * @return \DateTime
     */
    public function getTimeBegin();

    /**
     * Set the ending date and time.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTimeEnd($time);

    /**
     * Get the ending date and time.
     *
     * @return \DateTime
     */
    public function getTimeEnd();
}