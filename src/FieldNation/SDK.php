<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class SDK implements SDKInterface
{
    private $login;
    private $woService;

    /**
     * FieldNation\SDK constructor.
     * Access the Field Nation SDK.
     * @param LoginCredentialsInterface $login - Authenticate to the SDK
     */
    public function __construct(LoginCredentialsInterface $login)
    {
        $this->login = $login;
        $clientFactory = new SoapClientFactory();
        $this->woService = new WorkOrderService($clientFactory);
    }

    /**
     * Get all of your work orders
     *
     * @return WorkOrderInterface[]
     */
    public function getWorkOrders()
    {
        return $this->woService->getAll();
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
}