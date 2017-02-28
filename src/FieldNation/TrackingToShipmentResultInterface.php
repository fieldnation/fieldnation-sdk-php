<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface TrackingToShipmentResultInterface extends ResultInterface
{
    /**
     * Set the shipment id, as assigned by Field Nation
     * @param $id
     * @return string
     */
    public function setShipmentId($id);

    /**
     * Get the shipment id, as assigned by Field Nation
     *
     * @return string
     */
    public function getShipmentId();
}
