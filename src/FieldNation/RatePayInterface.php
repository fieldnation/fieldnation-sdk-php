<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface RatePayInterface
{
    /**
     * Set the pay rate
     *
     * @param float $rate
     * @return self
     */
    public function setRate($rate);

    /**
     * Get the pay rate.
     *
     * @return float
     */
    public function getRate();

    /**
     * Set the maximum units of payment allowed.
     *
     * @param float $units
     * @return self
     */
    public function setMaxUnits($units);

    /**
     * Get the maximum units of payment allowed.
     * @return float
     */
    public function getMaxUnits();
}