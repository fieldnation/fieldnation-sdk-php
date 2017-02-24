<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface BlendedPayInterface
{
    /**
     * Set the total payment for the base quantity hours as a whole.
     *
     * @param float $amount
     * @return self
     */
    public function setBaseAmount($amount);

    /**
     * Get the total payment for the base quantity hours as a whole.
     *
     * @return float
     */
    public function getBaseAmount();

    /**
     * Set the first period of hours that the base amount applies to.
     *
     * @param float $hours
     * @return self
     */
    public function setBaseHours($hours);

    /**
     * Get the first period of hours that the base amount applies to.
     *
     * @return float
     */
    public function getBaseHours();

    /**
     * Set the rate for hours in excess of what the base includes.
     *
     * @param float $rate
     * @return self
     */
    public function setAdditionalHourlyRate($rate);

    /**
     * Get the rate for hours in excess of what the base includes.
     *
     * @return float
     */
    public function getAdditionalHourlyRate();

    /**
     * Set the maximum amount of hours allowed in excess of the base.
     *
     * @param float $hours
     * @return self
     */
    public function setMaxAdditionalHours($hours);

    /**
     * Get the maximum amount of hours allowed in excess of the base.
     *
     * @return float
     */
    public function getMaxAdditionalHours();
}