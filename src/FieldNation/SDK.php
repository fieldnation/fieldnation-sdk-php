<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class SDK implements SDKInterface
{
    private $credentials;
    private $woService;
    private $projectService;
    private $shipmentService;
    private $documentService;

    /**
     * FieldNation\SDK constructor.
     * Access the Field Nation SDK.
     * @param SDKCredentialsInterface $credentials - Authenticate to the SDK
     * @param FactoryInjectorInterface $factoryInjector - Optionally inject a factory to resolve dependencies
     */
    public function __construct(
        SDKCredentialsInterface $credentials,
        FactoryInjectorInterface $factoryInjector = null
    ) {
    
        $this->credentials = $credentials;
        $this->load($factoryInjector);
    }

    /**
     * Get all of your work orders
     *
     * @param string $status Should be a const from WorkOrderStatuses
     * @return WorkOrderInterface[]
     */
    public function getWorkOrders($status = null)
    {
        return $this->woService->getAll($status);
    }

    /**
     * Create a new work order
     *
     * @param WorkOrderSerializerInterface $wo
     * @return WorkOrderInterface
     */
    public function createWorkOrder(WorkOrderSerializerInterface $wo)
    {
        return $this->woService->createNew($wo);
    }

    /**
     * Get an existing work order
     *
     * @param $workOrderId
     * @return WorkOrderInterface
     */
    public function getExistingWorkOrder($workOrderId)
    {
        return $this->woService->getExisting($workOrderId);
    }

    /**
     * This method will give you a high level overview of all the projects your company has in Field Nation.
     *
     * @return ProjectInterface[]
     */
    public function getProjects()
    {
        return $this->projectService->getAll();
    }

    /**
     * Get the shipping ID from a tracking number
     *
     * @param string $trackingNumber
     * @return TrackingToShipmentResultInterface
     */
    public function getShippingIdFrom($trackingNumber)
    {
        return $this->shipmentService->toShippingId($trackingNumber);
    }

    /**
     * Return an array of all your company documents, as well as some descriptive information.
     *
     * @return DocumentInterface[]
     */
    public function getDocuments()
    {
        return $this->documentService->getAll();
    }

    private function load(FactoryInjectorInterface $factoryInjector = null)
    {
        if ($factoryInjector) {
            $clientFactory = $factoryInjector->getClientFactory();
            $servicesFactory = $factoryInjector->getServicesFactory();
            $this->woService = $servicesFactory->getWorkOrderService($clientFactory);
            $this->projectService = $servicesFactory->getProjectService($clientFactory);
            $this->shipmentService = $servicesFactory->getShipmentService($clientFactory);
            $this->documentService = $servicesFactory->getDocumentService($clientFactory);
        } else {
            $clientFactory = new SoapClientFactory($this->credentials);
            $this->woService = new WorkOrderService($clientFactory);
            $this->projectService = new ProjectService($clientFactory);
            $this->shipmentService = new ShipmentService($clientFactory);
            $this->documentService = new DocumentService($clientFactory);
        }
    }
}
