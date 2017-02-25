<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class FixedPay implements FixedPayInterface
{
    private $amount;

    /**
     * Set the pay amount.
     *
     * @param float $amount
     * @return self
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get the pay amount.
     *
     * @return float
     */
    public function getAmount() {
        return $this->amount;
    }
}