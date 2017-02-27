<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface AdditionalExpenseInterface extends DescribableInterface, IdentifiableInterface
{
    /**
     * Set the category of the expense from the following list:
     *      'Uncategorized',
     *      'Material Cost',
     *      'Travel Expense',
     *      'Scope-of-Work Change'
     *
     * @param string $expenseCategory
     * @return self
     */
    public function setExpenseCategory($expenseCategory);

    /**
     * Get the category of the expense.
     *
     * @return string
     */
    public function getExpenseCategory();

    /**
     * Set the expense amount.
     *
     * @param float $amount
     * @return self
     */
    public function setAmount($amount);

    /**
     * Get the expense amount.
     *
     * @return float
     */
    public function getAmount();

    /**
     * Set if the expense is approved.
     *
     * @param boolean $isApproved
     * @return self
     */
    public function setIsApproved($isApproved);

    /**
     * Get if the expense is approved.
     *
     * @return boolean
     */
    public function getIsApproved();

    /**
     * Set the quantity entered by the user who submitted the additional expense, if the Expense Manager was used.
     *
     * @param float $amount
     * @return self
     */
    public function setQuantity($amount);

    /**
     * Get the quantity
     *
     * @return float
     */
    public function getQuantity();

    /**
     * Set the code of the expense item configured in the Expense Manager
     *
     * @param string $expenseId
     * @return self
     */
    public function setCustomExpenseId($expenseId);

    /**
     * Get the code of the expense item configured in the Expense Manager
     *
     * @return string
     */
    public function getCustomExpenseId();

    /**
     * Set the reason an expense was denied.
     *
     * @param string $reason
     * @return self
     */
    public function setReasonDenied($reason);

    /**
     * Get the reason an expense was denied.
     *
     * @return string
     */
    public function getReasonDenied();
}