<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ResultInterface
{
    /**
     * Was the request successful?
     *
     * @return boolean
     */
    public function setSuccessful($success);

    /**
     * Was the request successful?
     *
     * @return boolean
     */
    public function wasSuccessful();

    /**
     * A message that explains the success or failure.
     *
     * @return string
     */
    public function getMessage();

    /**
     * Set the message.
     *
     * @param $message
     * @return self
     */
    public function setMessage($message);

    /**
     * Get to work order id, if applicable.
     *
     * @return integer|NULL
     */
    public function getWorkOrderId();

    /**
     * Set the work order id.
     *
     * @param integer $id
     * @return self
     */
    public function setWorkOrderId($id);
}
