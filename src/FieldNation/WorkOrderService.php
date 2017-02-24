<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class WorkOrderService
{
    private $client;

    public function __construct(ClientFactoryInterface $factory)
    {
        $this->client = $factory->getClient();
    }

    /**
     * Return all of the work orders for your company
     *
     * @return WorkOrderInterface[]
     */
    public function getAll()
    {
        // TODO: Implement stubbed function
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
             ->setTime($wo->getStartTime())
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
        // TODO: Implement getExisting() method.
    }
}