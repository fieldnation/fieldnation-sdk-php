<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface CheckInOutInterface
{
    /**
     * Set the GPS latitude
     *
     * @param float $value
     * @return self
     */
    public function setGpsLatitude($value);

    /**
     * Get the GPS latitude
     *
     * @return float
     */
    public function getGpsLatitude();

    /**
     * Set the GPS longitude
     * @param float $value
     * @return self
     */
    public function setGpsLongitude($value);

    /**
     * Get the GPS longitude
     * @return float
     */
    public function getGpsLongitude();

    /**
     * Set the true time of entry.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setTrueTime($time);

    /**
     * Get the true time of entry.
     *
     * @return \DateTime
     */
    public function getTrueTime();
}
