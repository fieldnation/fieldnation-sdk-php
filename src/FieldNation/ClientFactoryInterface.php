<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ClientFactoryInterface
{
    /**
     * ClientFactoryInterface constructor. The client always needs credentials
     * @param SDKCredentialsInterface $credentials
     * @param ClassMapFactoryInterface $factory
     */
    public function __construct(SDKCredentialsInterface $credentials, ClassMapFactoryInterface $factory);

    /**
     * Get a client to fulfil requests
     *
     * @param string $version - Optional client version. May not be supported by all clients
     * @return ClientInterface
     */
    public function getClient($version = null);

    /**
     * Set the version of the client
     *
     * @param $version
     * @return self
     */
    public function setClientVersion($version);

    /**
     * Get the version of the client
     *
     * @return string|NULL
     */
    public function getClientVersion();
}
