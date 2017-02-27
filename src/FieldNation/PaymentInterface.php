<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface PaymentInterface
{
    /**
     * Set all of the reported expenses entered on the work order.
     *
     * @param AdditionalExpenseInterface[] $expenses
     * @return self
     */
    public function setExpenses($expenses);

    /**
     * Get all of the reported expenses entered on the work order.
     *
     * @return AdditionalExpenseInterface[]
     */
    public function getExpenses();

    /**
     * Set all of the deductions available for the work order.
     *
     * @param PaymentDeductionInterface[] $deductions
     * @return self
     */
    public function setDeductions($deductions);

    /**
     * Get all of the deductions available for the work order.
     *
     * @return PaymentDeductionInterface[]
     */
    public function getDeduction();

    /**
     * Set either the product of the labor rate and the quantity entered, or the max pay amount on the work order.
     *
     * @param float $amount
     * @return self
     */
    public function setLaborEarned($amount);

    /**
     * Get either the product of the labor rate and the quantity entered, or the max pay amount on the work order.
     *
     * @return float
     */
    public function getLaborEarned();

    /**
     * Set the total sum of all approved expenses.
     *
     * @param $amount
     * @return self
     */
    public function setTotalApprovedExpenses($amount);

    /**
     * Get the total sum of all approved expenses.
     *
     * @return float
     */
    public function getTotalApprovedExpenses();

    /**
     * Set the total sum of active deductions.
     *
     * @param $amount
     * @return self
     */
    public function setTotalDeductions($amount);

    /**
     * Get the total sum of active deductions.
     *
     * @return float
     */
    public function getTotalDeductions();

    /**
     * Set the total payment amount.
     *
     * @param $amount
     * @return self
     */
    public function setPaymentAmount($amount);

    /**
     * Get the total payment amount.
     *
     * @return float
     */
    public function getPaymentAmount();

    /**
     * Set the cancellation fee.
     *
     * @param $amount
     * @return self
     */
    public function setCancelFee($amount);

    /**
     * Get the cancellation fee.
     *
     * @return float
     */
    public function getCancelFee();
}
