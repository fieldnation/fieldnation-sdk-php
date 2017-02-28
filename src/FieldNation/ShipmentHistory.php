<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class ShipmentHistory extends Shipment
{
    private $history;

    /**
     * Set the shipment history
     *
     * @param HistoryInterface[] $history
     * @return self
     */
    public function setShipmentHistory($history) {
        $this->history = $history;
        return $this;
    }

    /**
     * Get the history of a shipment.
     *
     * @return HistoryInterface[]
     */
    public function getShipmentHistory() {
        return $this->history;
    }
}
