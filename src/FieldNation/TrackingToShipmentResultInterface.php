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
     * Get the shipment id, as assigned by Field Nation
     *
     * @return string
     */
    public function getShipmentId();
}
