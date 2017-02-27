<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class AdditionalExpense implements AdditionalExpenseInterface
{
    private $id;
    private $description;
    private $category;
    private $amount;
    private $approved;
    private $quantity;
    private $customId;
    private $reasonDenied;

    /**
     * Set the id
     *
     * @param integer $id
     * @return self
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the description.
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set the quantity entered by the user who submitted the additional expense, if the Expense Manager was used.
     *
     * @param float $amount
     * @return self
     */
    public function setQuantity($amount) {
        $this->quantity = (float)$amount;
        return $this;
    }

    /**
     * Get the quantity
     *
     * @return float
     */
    public function getQuantity() {
        return $this->quantity;
    }

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
    public function setExpenseCategory($expenseCategory) {
        $this->category = $expenseCategory;
        return $this;
    }

    /**
     * Get the category of the expense.
     *
     * @return string
     */
    public function getExpenseCategory() {
        return $this->category;
    }

    /**
     * Set the expense amount.
     *
     * @param float $amount
     * @return self
     */
    public function setAmount($amount) {
        $this->amount = (float)$amount;
        return $this;
    }

    /**
     * Get the expense amount.
     *
     * @return float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Set if the expense is approved.
     *
     * @param boolean $isApproved
     * @return self
     */
    public function setIsApproved($isApproved) {
        $this->approved = (boolean)$isApproved;
        return $this;
    }

    /**
     * Get if the expense is approved.
     *
     * @return boolean
     */
    public function getIsApproved() {
        return $this->approved;
    }

    /**
     * Set the code of the expense item configured in the Expense Manager
     *
     * @param string $expenseId
     * @return self
     */
    public function setCustomExpenseId($expenseId) {
        $this->customId = $expenseId;
        return $this;
    }

    /**
     * Get the code of the expense item configured in the Expense Manager
     *
     * @return string
     */
    public function getCustomExpenseId() {
        return $this->customId;
    }

    /**
     * Set the reason an expense was denied.
     *
     * @param string $reason
     * @return self
     */
    public function setReasonDenied($reason) {
        $this->reasonDenied = $reason;
        return $this;
    }

    /**
     * Get the reason an expense was denied.
     *
     * @return string
     */
    public function getReasonDenied() {
        return $this->reasonDenied;
    }
}