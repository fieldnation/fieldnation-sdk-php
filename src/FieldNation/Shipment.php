<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Shipment implements ShipmentInterface
{
    private $id;
    private $vendor;
    private $description;
    private $status;
    private $lastActivityDate;

    /**
     * Set the id
     *
     * @param integer $id
     * @return self
     */
    public function setId($id) {
        $this->id = (integer)$id;
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
     * Set the shipping vendor.
     *
     * @param string $vendor
     * @return self
     */
    public function setVendor($vendor) {
        $this->vendor = $vendor;
        return $this;
    }

    /**
     * Get the shipping vendor.
     *
     * @return string
     */
    public function getVendor() {
        return $this->vendor;
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
     * Set the shipping status.
     *
     * @param string $status
     * @return self
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the status of the shipment.
     *
     * @return string
     */
    public function getStatus() {
        return $this->vendor;
    }

    /**
     * Set the last activity date
     *
     * @param \DateTime $date
     * @return self
     */
    public function setLastActivityDate($date) {
        $this->lastActivityDate = $date;
        return $this;
    }

    /**
     * Get the last activity date.
     *
     * @return \DateTime
     */
    public function getLastActivityDate() {
        return $this->lastActivityDate;
    }
}
