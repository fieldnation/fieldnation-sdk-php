<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class LoginCredentials implements SDKCredentialsInterface
{
    private $apiKey;
    private $customerId;
    private $effectiveUser;
    private $environment;

    public function __construct($customerId, $apiKey, $effectiveUser = null)
    {
        $this->apiKey = $apiKey;
        $this->customerId = $customerId;
        $this->effectiveUser = $effectiveUser;
    }

    public function setApiKey($key)
    {
        $this->apiKey = $key;
        return $this;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setCustomerId($id)
    {
        $this->customerId = $id;
        return $this;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setEffectiveUser($user)
    {
        $this->effectiveUser = $user;
        return $this;
    }

    public function getEffectiveUser()
    {
        return $this->effectiveUser;
    }

    /**
     * Set which environment to target
     *
     * @param string $env
     * @return self
     */
    public function setEnvironment($env)
    {
        $this->environment = $env;
        return $this;
    }

    /**
     * Get the environment we should target
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
}
