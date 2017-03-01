<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ServicesFactoryInterface
{
    /**
     * @param WorkOrderServiceInterface $service
     * @return self
     */
    public function setWorkOrderService(WorkOrderServiceInterface $service);

    /**
     * @param ClientFactoryInterface $factory
     * @return WorkOrderServiceInterface
     */
    public function getWorkOrderService(ClientFactoryInterface $factory);

    /**
     * @param ServiceInterface $service
     * @return self
     */
    public function setProjectService(ServiceInterface $service);

    /**
     * @param ClientFactoryInterface $factory
     * @return ServiceInterface
     */
    public function getProjectService(ClientFactoryInterface $factory);

    /**
     * @param ShipmentServiceInterface $service
     * @return self
     */
    public function setShipmentService(ShipmentServiceInterface $service);

    /**
     * @param ClientFactoryInterface $factory
     * @return ShipmentServiceInterface
     */
    public function getShipmentService(ClientFactoryInterface $factory);

    /**
     * @param ServiceInterface $service
     * @return self
     */
    public function setDocumentService(ServiceInterface $service);

    /**
     * @param ClientFactoryInterface $factory
     * @return ServiceInterface
     */
    public function getDocumentService(ClientFactoryInterface $factory);
}
