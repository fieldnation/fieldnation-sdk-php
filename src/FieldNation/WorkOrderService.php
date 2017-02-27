<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class WorkOrderService extends AbstractService
{
    /**
     * Return all of the work orders for your company
     *
     * @param $status - Should be a status from WorkOrderStatuses
     * @return WorkOrderInterface[]
     */
    public function getAll($status=NULL)
    {
        return $this->client->getWorkOrders($status);
    }

    /**
     * Create a new Work Order on Field Nation
     *
     * @param WorkOrderSerializerInterface $wo
     * @return WorkOrderInterface
     */
    public function createNew(WorkOrderSerializerInterface $wo)
    {
        $fnWo = new WorkOrder($this->client);
        $fnWo->setGroup($wo->getGroup())
             ->setDescription($wo->getDescription())
             ->setLocation($wo->getLocation())
             ->setStartTime($wo->getStartTime())
             ->setPayInfo($wo->getPayInfo())
             ->setAllowTechUploads($wo->getAllowTechUploads())
             ->setWillAlertWhenPublished($wo->getWillAlertWhenPublished())
             ->setIsPrintable($wo->getIsPrintable())
             ->setAdditionalFields($wo->getAdditionalFields())
             ->setLabels($wo->getLabels())
             ->setCloseoutRequirements($wo->getCloseoutRequirements())
             ->create();
        return $fnWo;
    }

    /**
     * Get an existing Work Order
     *
     * @param $workOrderId
     * @return WorkOrderInterface
     */
    public function getExisting($workOrderId)
    {
        return $this->client->getWorkOrder($workOrderId);
    }
}