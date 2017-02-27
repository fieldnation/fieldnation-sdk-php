<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class Payment implements PaymentInterface
{
    private $expenses;
    private $deductions;
    private $laborEarned;
    private $totalApprovedExpenses;
    private $totalDeductions;
    private $paymentAmount;
    private $cancelFee;

    /**
     * Set all of the reported expenses entered on the work order.
     *
     * @param AdditionalExpenseInterface[] $expenses
     * @return self
     */
    public function setExpenses($expenses) {
        $this->expenses = $expenses;
        return $this;
    }

    /**
     * Get all of the reported expenses entered on the work order.
     *
     * @return AdditionalExpenseInterface[]
     */
    public function getExpenses() {
        return $this->expenses;
    }

    /**
     * Set all of the deductions available for the work order.
     *
     * @param PaymentDeductionInterface[] $deductions
     * @return self
     */
    public function setDeductions($deductions) {
        $this->deductions = $deductions;
        return $this;
    }

    /**
     * Get all of the deductions available for the work order.
     *
     * @return PaymentDeductionInterface[]
     */
    public function getDeduction() {
        return $this->deductions;
    }

    /**
     * Set either the product of the labor rate and the quantity entered, or the max pay amount on the work order.
     *
     * @param float $amount
     * @return self
     */
    public function setLaborEarned($amount) {
        $this->laborEarned = $amount;
        return $this;
    }

    /**
     * Get either the product of the labor rate and the quantity entered, or the max pay amount on the work order.
     *
     * @return float
     */
    public function getLaborEarned() {
        return $this->laborEarned;
    }

    /**
     * Set the total sum of all approved expenses.
     *
     * @param $amount
     * @return self
     */
    public function setTotalApprovedExpenses($amount) {
        $this->totalApprovedExpenses = (float)$amount;
        return $this;
    }

    /**
     * Get the total sum of all approved expenses.
     *
     * @return float
     */
    public function getTotalApprovedExpenses() {
        return $this->totalApprovedExpenses;
    }

    /**
     * Set the total sum of active deductions.
     *
     * @param $amount
     * @return self
     */
    public function setTotalDeductions($amount) {
        $this->totalDeductions = (float)$amount;
        return $this;
    }

    /**
     * Get the total sum of active deductions.
     *
     * @return float
     */
    public function getTotalDeductions() {
        return $this->totalDeductions;
    }

    /**
     * Set the total payment amount.
     *
     * @param $amount
     * @return self
     */
    public function setPaymentAmount($amount) {
        $this->paymentAmount = (float)$amount;
        return $this;
    }

    /**
     * Get the total payment amount.
     *
     * @return float
     */
    public function getPaymentAmount() {
        return $this->paymentAmount;
    }

    /**
     * Set the cancellation fee.
     *
     * @param $amount
     * @return self
     */
    public function setCancelFee($amount) {
        $this->cancelFee = (float)$amount;
        return $this;
    }

    /**
     * Get the cancellation fee.
     *
     * @return float
     */
    public function getCancelFee() {
        return $this->cancelFee;
    }
}