<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ShipmentServiceInterface extends ServiceInterface
{
    /**
     * Convert a tracking number into FN shipping id
     * @param $trackingId
     * @return TrackingToShipmentResultInterface
     */
    public function toShippingId($trackingNumber);
}
