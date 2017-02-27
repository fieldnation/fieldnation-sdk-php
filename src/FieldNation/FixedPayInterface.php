<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface FixedPayInterface
{
    /**
     * Set the pay amount.
     *
     * @param float $amount
     * @return self
     */
    public function setAmount($amount);

    /**
     * Get the pay amount.
     *
     * @return float
     */
    public function getAmount();
}
