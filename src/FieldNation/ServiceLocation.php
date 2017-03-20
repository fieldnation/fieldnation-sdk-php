<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class ServiceLocation implements ServiceLocationInterface
{
    private $type;
    private $name;
    private $address1;
    private $address2;
    private $city;
    private $state;
    private $postalCode;
    private $country;
    private $contactName;
    private $contactPhone;
    private $contactEmail;
    private $isRemote;

    /**
     * Set the location type.
     * Only accepted values are constants on the LocationTypes class.
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the location type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the name of the location.
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name of the location.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the first line of the street address.
     *
     * @param string $address1
     * @return self
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * Get the first line of the street address.
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set the second line of the street address.
     *
     * @param string $address2
     * @return self
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * Get the second line of the street address.
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set the city.
     *
     * @param string $city
     * @return self
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get the city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the state.
     *
     * @param string $state
     * @return self
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get the state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the postal code.
     *
     * @param string $postalCode
     * @return self
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Get the postal code.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set the country code.
     *
     * @param string $country
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get the country code.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the contact name.
     *
     * @param string $name
     * @return self
     */
    public function setContactName($name)
    {
        $this->contactName = $name;
        return $this;
    }

    /**
     * Get the contact name.
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set the contact phone number.
     *
     * @param string $phone
     * @return self
     */
    public function setContactPhone($phone)
    {
        $this->contactPhone = $phone;
        return $this;
    }

    /**
     * Get the contact phone number.
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set the contact email address.
     *
     * @param string $email
     * @return self
     */
    public function setContactEmail($email)
    {
        $this->contactEmail = $email;
        return $this;
    }

    /**
     * Get the contact email address.
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set the is remote flag
     *
     * @param boolean $flag
     * @return self
     */
    public function setIsRemote($flag) {
        $this->isRemote = (boolean) $flag;
    }

    /**
     * Get the is remote flag
     *
     * @return boolean
     */
    public function getIsRemote() {
        return $this->isRemote;
    }
}
