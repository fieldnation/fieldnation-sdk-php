<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface FactoryInjectorInterface
{
    /**
     * Set the client factory
     *
     * @param ClientFactoryInterface $factory
     * @return self
     */
    public function setClientFactory(ClientFactoryInterface $factory);

    /**
     * Get the client factory
     *
     * @return ClientFactoryInterface
     */
    public function getClientFactory();

    /**
     * Set the services factory
     *
     * @param ServicesFactoryInterface $factory
     * @return self
     */
    public function setServicesFactory(ServicesFactoryInterface $factory);

    /**
     * Get the services factory
     *
     * @return ServicesFactoryInterface
     */
    public function getServicesFactory();
}
