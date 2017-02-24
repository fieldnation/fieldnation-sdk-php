<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface ShipmentInterface extends IdentifiableInterface, DescribableInterface
{
    /**
     * Set the shipping vendor.
     *
     * @param string $vendor
     * @return self
     */
    public function setVendor($vendor);

    /**
     * Get the shipping vendor.
     *
     * @return string
     */
    public function getVendor();

    /**
     * Set the shipping status.
     *
     * @param string $status
     * @return self
     */
    public function setStatus($status);

    /**
     * Get the status of the shipment.
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set the last activity date
     *
     * @param \DateTime $date
     * @return self
     */
    public function setLastActivityDate($date);

    /**
     * Get the last activity date.
     *
     * @return \DateTime
     */
    public function getLastActivityDate();
}