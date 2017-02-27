<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

abstract class AbstractService
{
    protected $client;

    public function __construct(ClientFactoryInterface $factory)
    {
        $this->client = $factory->getClient();
    }
}
