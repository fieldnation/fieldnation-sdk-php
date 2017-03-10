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
    private static $client;
    private static $classMap = null;
    private static $version = null;

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
        return self::$client->getWorkOrders($status);
    }

    /**
     * Create a new work order
     *
     * @throws \UnexpectedValueException - WorkOrderSerializerInterface property is not of the expected return type
     * @throws \InvalidArgumentException - WorkOrderSerializerInterface required property is not found
     * @param WorkOrderSerializerInterface $wo
     * @param  boolean $useTemplate
     * @return WorkOrderInterface
     */
    public function createWorkOrder(WorkOrderSerializerInterface $wo, $useTemplate = false)
    {
        TypeValidator::validateWorkOrderSerializerInterface($wo);
        return self::$client->createWorkOrder($wo, $useTemplate);
    }

    /**
     * Get an existing work order
     *
     * @param $workOrderId
     * @return WorkOrderInterface
     */
    public function getExistingWorkOrder($workOrderId)
    {
        return self::$client->getWorkOrder($workOrderId);
    }

    /**
     * This method will give you a high level overview of all the projects your company has in Field Nation.
     *
     * @return ProjectInterface[]
     */
    public function getProjects()
    {
        return self::$client->getProjects();
    }

    /**
     * Get the shipping ID from a tracking number
     *
     * @param string $trackingNumber
     * @return TrackingToShipmentResultInterface
     */
    public function getShippingIdFrom($trackingNumber)
    {
        return self::$client->convertTrackingIdToShippingId($trackingNumber);
    }

    /**
     * Return an array of all your company documents, as well as some descriptive information.
     *
     * @return DocumentInterface[]
     */
    public function getDocuments()
    {
        return self::$client->getDocuments();
    }

    private function load(FactoryInjectorInterface $factoryInjector = null)
    {
        if ($factoryInjector) {
            self::$client = $factoryInjector->getClientFactory()->getClient(self::$version);
        } else {
            $clientFactory = new SoapClientFactory($this->credentials, self::$classMap);
            self::$client = $clientFactory->getClient(self::$version);
        }
    }

    /**
     * @return ClientInterface
     */
    public static function getClient()
    {
        return self::$client;
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

    /**
     * Override the version the client will use.
     * Make sure you understand what versions the client uses for the SDK version.
     * The SDK will die a horrific death if you get the version wrong.
     * Proceed with caution, here be dragons.
     *
     * @param $version
     */
    public static function overrideClientVersion($version)
    {
        self::$version = $version;
    }
}
