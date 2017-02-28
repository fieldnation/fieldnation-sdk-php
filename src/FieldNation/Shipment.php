<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Shipment implements ShipmentInterface
{
    use IdentifiableTrait;
    use DescribableTrait;

    private $vendor;
    private $status;
    private $lastActivityDate;

    /**
     * Set the shipping vendor.
     *
     * @param string $vendor
     * @return self
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }

    /**
     * Get the shipping vendor.
     *
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set the shipping status.
     *
     * @param string $status
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the status of the shipment.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->vendor;
    }

    /**
     * Set the last activity date
     *
     * @param \DateTime $date
     * @return self
     */
    public function setLastActivityDate($date)
    {
        $this->lastActivityDate = $date;
        return $this;
    }

    /**
     * Get the last activity date.
     *
     * @return \DateTime
     */
    public function getLastActivityDate()
    {
        return $this->lastActivityDate;
    }
}
