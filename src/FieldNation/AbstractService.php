<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

abstract class AbstractService implements ServiceInterface
{
    protected $client;
    private $factory;

    public function __construct(ClientFactoryInterface $factory = null)
    {
        $this->setClientFactory($factory);
        $this->client = $this->getClientFactory()->getClient();
    }

    public function setClientFactory(ClientFactoryInterface $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    private function getClientFactory()
    {
        return $this->factory;
    }
}
