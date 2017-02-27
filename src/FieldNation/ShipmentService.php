<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class ShipmentService extends AbstractService
{
    public function toShippingId($trackingNumber)
    {
        return $this->client->convertTrackingIdToShippingId($trackingNumber);
    }
}