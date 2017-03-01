<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface WorkOrderServiceInterface extends ServiceInterface
{
    /**
     * Create a new Work Order on Field Nation
     *
     * @param WorkOrderSerializerInterface $wo
     * @return WorkOrderInterface
     */
    public function createNew(WorkOrderSerializerInterface $wo);

    /**
     * Get an existing Work Order
     *
     * @param $workOrderId
     * @return WorkOrderInterface
     */
    public function getExisting($workOrderId);
}
