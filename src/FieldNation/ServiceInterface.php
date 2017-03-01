<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ServiceInterface
{
    /**
     * ServiceInterface constructor.
     * @param ClientFactoryInterface $factory
     */
    public function __construct(ClientFactoryInterface $factory = null);

    /**
     * Get all of the type managed by the service
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Inject the ClientFactoryInterface
     * @param ClientFactoryInterface $factory
     * @return self
     */
    public function setClientFactory(ClientFactoryInterface $factory);
}
