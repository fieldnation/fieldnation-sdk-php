<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class BlendedPay implements BlendedPayInterface
{
    private $baseAmount;
    private $baseHours;
    private $additionalHourlyRate;
    private $maxAdditionalHours;

    /**
     * Set the total payment for the base quantity hours as a whole.
     *
     * @param float $amount
     * @return self
     */
    public function setBaseAmount($amount)
    {
        $this->baseAmount = $amount;
        return $this;
    }

    /**
     * Get the total payment for the base quantity hours as a whole.
     *
     * @return float
     */
    public function getBaseAmount()
    {
        return $this->baseAmount;
    }

    /**
     * Set the first period of hours that the base amount applies to.
     *
     * @param float $hours
     * @return self
     */
    public function setBaseHours($hours)
    {
        $this->baseHours = $hours;
        return $this;
    }

    /**
     * Get the first period of hours that the base amount applies to.
     *
     * @return float
     */
    public function getBaseHours()
    {
        return $this->baseHours;
    }

    /**
     * Set the rate for hours in excess of what the base includes.
     *
     * @param float $rate
     * @return self
     */
    public function setAdditionalHourlyRate($rate)
    {
        $this->additionalHourlyRate = $rate;
        return $this;
    }

    /**
     * Get the rate for hours in excess of what the base includes.
     *
     * @return float
     */
    public function getAdditionalHourlyRate()
    {
        return $this->additionalHourlyRate;
    }

    /**
     * Set the maximum amount of hours allowed in excess of the base.
     *
     * @param float $hours
     * @return self
     */
    public function setMaxAdditionalHours($hours)
    {
        $this->maxAdditionalHours = $hours;
        return $this;
    }

    /**
     * Get the maximum amount of hours allowed in excess of the base.
     *
     * @return float
     */
    public function getMaxAdditionalHours()
    {
        return $this->maxAdditionalHours;
    }
}
