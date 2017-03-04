<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ShipmentHistoryInterface extends ShipmentInterface
{
    /**
     * Set the shipment history
     *
     * @param HistoryInterface[] $history
     * @return self
     */
    public function setShipmentHistory($history);

    /**
     * Get the history of a shipment.
     *
     * @return HistoryInterface[]
     */
    public function getShipmentHistory();
}
