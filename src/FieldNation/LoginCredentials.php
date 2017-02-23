<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class LoginCredentials implements LoginCredentialsInterface
{
    private $apiKey;
    private $customerId;
    private $effectiveUser;

    public function __construct($customerId, $apiKey, $effectiveUser = NULL)
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
}