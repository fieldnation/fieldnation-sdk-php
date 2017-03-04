<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface PaymentDeductionInterface extends DescribableInterface
{
    /**
     * Set the type of payment deduction, generally just "discount".
     * @param string $type
     * @return self
     */
    public function setType($type);

    /**
     * Get the type of payment deduction
     *
     * @return string
     */
    public function getType();

    /**
     * Set the total amount of the discount to be subtracted from the Work Order base total, in dollars.
     * @param string $amount
     * @return self
     */
    public function setAmount($amount);

    /**
     * Get the type of payment deduction
     *
     * @return float
     */
    public function getAmount();
}
