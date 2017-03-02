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
    private $client;
    private static $classMap = null;

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
        return $this->client->getWorkOrders($status);
    }

    /**
     * Create a new work order
     *
     * @param WorkOrderSerializerInterface $wo
     * @param  boolean $useTemplate
     * @return WorkOrderInterface
     */
    public function createWorkOrder(WorkOrderSerializerInterface $wo, $useTemplate = false)
    {
        return $this->client->createWorkOrder($wo, $useTemplate);
    }

    /**
     * Get an existing work order
     *
     * @param $workOrderId
     * @return WorkOrderInterface
     */
    public function getExistingWorkOrder($workOrderId)
    {
        return $this->client->getWorkOrder($workOrderId);
    }

    /**
     * This method will give you a high level overview of all the projects your company has in Field Nation.
     *
     * @return ProjectInterface[]
     */
    public function getProjects()
    {
        return $this->client->getProjects();
    }

    /**
     * Get the shipping ID from a tracking number
     *
     * @param string $trackingNumber
     * @return TrackingToShipmentResultInterface
     */
    public function getShippingIdFrom($trackingNumber)
    {
        return $this->client->convertTrackingIdToShippingId($trackingNumber);
    }

    /**
     * Return an array of all your company documents, as well as some descriptive information.
     *
     * @return DocumentInterface[]
     */
    public function getDocuments()
    {
        return $this->client->getDocuments();
    }

    private function load(FactoryInjectorInterface $factoryInjector = null)
    {
        if ($factoryInjector) {
            $this->client = $factoryInjector->getClientFactory()->getClient();
        } else {
            $clientFactory = new SoapClientFactory($this->credentials, self::$classMap);
            $this->client = $clientFactory->getClient();
        }
    }

    /**
     * Inject client-implemented classes into the classMapFactory
     * @param callable $callback
     * @return void
     */
    public static function configure(callable $callback)
    {
        if (self::$classMap == null) {
            self::$classMap = ClassMapFactory::get();
        }
        $callback(self::$classMap);
    }
}
