<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class ServicesFactory implements ServicesFactoryInterface
{
    private $workOrderService;
    private $projectService;
    private $shipmentService;
    private $documentService;

    /**
     * @param WorkOrderServiceInterface $service
     * @return self
     */
    public function setWorkOrderService(WorkOrderServiceInterface $service)
    {
        $this->workOrderService = $service;
        return $this;
    }

    /**
     * @param ClientFactoryInterface $factory
     * @return WorkOrderServiceInterface
     */
    public function getWorkOrderService(ClientFactoryInterface $factory)
    {
        $this->workOrderService->setClientFactory($factory);
        return $this->workOrderService;
    }

    /**
     * @param ServiceInterface $service
     * @return self
     */
    public function setProjectService(ServiceInterface $service)
    {
        $this->projectService = $service;
        return $this;
    }

    /**
     * @param ClientFactoryInterface $factory
     * @return ServiceInterface
     */
    public function getProjectService(ClientFactoryInterface $factory)
    {
        $this->projectService->setClientFactory($factory);
        return $this->projectService;
    }

    /**
     * @param ShipmentServiceInterface $service
     * @return self
     */
    public function setShipmentService(ShipmentServiceInterface $service)
    {
        $this->shipmentService = $service;
        return $this;
    }

    /**
     * @param ClientFactoryInterface $factory
     * @return ShipmentServiceInterface
     */
    public function getShipmentService(ClientFactoryInterface $factory)
    {
        $this->shipmentService->setClientFactory($factory);
        return $this->shipmentService;
    }

    /**
     * @param ServiceInterface $service
     * @return self
     */
    public function setDocumentService(ServiceInterface $service)
    {
        $this->documentService = $service;
        return $this;
    }

    /**
     * @param ClientFactoryInterface $factory
     * @return ServiceInterface
     */
    public function getDocumentService(ClientFactoryInterface $factory)
    {
        $this->documentService->setClientFactory($factory);
        return $this->documentService;
    }
}
