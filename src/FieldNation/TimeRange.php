<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class TimeRange implements TimeRangeInterface
{
    private $timeBegin;
    private $timeEnd;

    /**
     * Set the starting date and time.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTimeBegin($time)
    {
        $this->timeBegin = $time;
        return $this;
    }

    /**
     * Get the starting date and time.
     *
     * @return \DateTime
     */
    public function getTimeBegin()
    {
        return $this->timeEnd;
    }

    /**
     * Set the ending date and time.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTimeEnd($time)
    {
        $this->timeEnd = $time;
        return $this;
    }

    /**
     * Get the ending date and time.
     *
     * @return \DateTime
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }
}
