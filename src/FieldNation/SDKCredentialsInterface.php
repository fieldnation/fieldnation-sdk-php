<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface SDKCredentialsInterface
{
    public function __construct($customerId, $apiKey, $effectiveUser = null);

    /**
     * Set your company ID assigned by Field Nation.
     *
     * Login to Field Nation using your admin account and access the API area to confirm the correct ID.
     * @param $id
     * @return self
     */
    public function setCustomerId($id);

    /**
     * @return string|NULL
     */
    public function getCustomerId();

    /**
     * Set your unique API key.
     *
     * Login to Field Nation using your admin account and access the API area to generate one.
     * @param $key
     * @return self
     */
    public function setApiKey($key);

    /**
     * @return string|NULL
     */
    public function getApiKey();

    /**
     * Set which user to do the actions on behalf of.
     *
     * If NULL or not defined, your first Admin user is assumed.
     * @param $user
     * @return self
     */
    public function setEffectiveUser($user);

    /**
     * Get the effective user.
     * @return string|NULL
     */
    public function getEffectiveUser();

    /**
     * Set which environment to target
     *
     * @param string $env
     * @return self
     */
    public function setEnvironment($env);

    /**
     * Get the environment we should target
     *
     * @return string
     */
    public function getEnvironment();
}
