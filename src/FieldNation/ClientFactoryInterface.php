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
     */
    public function __construct(SDKCredentialsInterface $credentials);

    /**
     * Get a client to fulfil requests
     *
     * @param string $version - Optional client version. May not be supported by all clients
     * @return ClientInterface
     */
    public function getClient($version = null);
}
