<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class PaymentDeduction implements PaymentDeductionInterface
{
    private $type;
    private $description;
    private $amount;

    /**
     * Set the type of payment deduction, generally just "discount".
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the type of payment deduction
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the description.
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the total amount of the discount to be subtracted from the Work Order base total, in dollars.
     * @param string $amount
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = (float)$amount;
        return $this;
    }

    /**
     * Get the type of payment deduction
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
