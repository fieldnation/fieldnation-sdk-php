<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class RatePay implements RatePayInterface
{
    private $rate;
    private $maxUntis;
    /**
     * Set the pay rate
     *
     * @param float $rate
     * @return self
     */
    public function setRate($rate) {
        $this->rate = $rate;
        return $this;
    }

    /**
     * Get the pay rate.
     *
     * @return float
     */
    public function getRate() {
        return $this->rate;
    }

    /**
     * Set the maximum units of payment allowed.
     *
     * @param float $units
     * @return self
     */
    public function setMaxUnits($units) {
        $this->maxUntis = $units;
        return $this;
    }

    /**
     * Get the maximum units of payment allowed.
     * @return float
     */
    public function getMaxUnits() {
        return $this->maxUntis;
    }
}