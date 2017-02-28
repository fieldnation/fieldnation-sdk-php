<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

abstract class Result implements ResultInterface
{
    protected $message;
    protected $workOrderId;
    protected $success;

    /**
     * Set if request successful?
     *
     * @param $success
     * @return self
     */
    public function setSuccessful($success) {
        $this->success = (boolean) $success;
    }

    /**
     * Was the request successful?
     *
     * @return boolean
     */
    abstract public function wasSuccessful();

    /**
     * A message that explains the success or failure.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the message.
     *
     * @param $message
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get to work order id, if applicable.
     *
     * @return integer|NULL
     */
    public function getWorkOrderId()
    {
        return $this->workOrderId;
    }

    /**
     * Set the work order id.
     *
     * @param integer $id
     * @return self
     */
    public function setWorkOrderId($id)
    {
        $this->workOrderId = $id;
        return $this;
    }
}
