<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class TrackingToShipmentResult implements TrackingToShipmentResultInterface
{
    private $success;
    private $shipmentId;
    private $workorderId;

    /**
     * Was the request successful?
     *
     * @return boolean
     */
    public function setSuccessful($success)
    {
        $this->success = (boolean)$success;
        return $this;
    }
    
    /**
     * Was the request successful?
     *
     * @return boolean
     */
    public function wasSuccessful()
    {
        return $this->success;
    }

    /**
     * A message that explains the success or failure.
     *
     * @return string
     */
    public function getMessage()
    {
        return '';
    }

    /**
     * Set the message.
     *
     * @param $message
     * @return self
     */
    public function setMessage($message)
    {
        // No messages expected
        return $this;
    }
    
    /**
     * Get to work order id, if applicable.
     *
     * @return integer|NULL
     */
    public function getWorkOrderId()
    {
        return $this->workorderId;
    }

    /**
     * Set the work order id.
     *
     * @param integer $id
     * @return self
     */
    public function setWorkOrderId($id)
    {
        $this->workorderId = (integer)$id;
        return $this;
    }

    /**
     * Set the shipment id, as assigned by Field Nation
     *
     * @return string
     */
    public function setShipmentId($id)
    {
        $this->shipmentId = (integer)$id;
        return $this;
    }

    /**
     * Get the shipment id, as assigned by Field Nation
     *
     * @return string
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }
}
