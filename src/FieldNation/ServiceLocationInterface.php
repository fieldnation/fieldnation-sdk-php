<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface ServiceLocationInterface
{
    /**
     * Set the location type.
     * Only accepted values are constants on the LocationTypes class.
     *
     * @param string $type
     * @return self
     */
    public function setType($type);

    /**
     * Get the location type.
     *
     * @return string
     */
    public function getType();

    /**
     * Set the name of the location.
     *
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * Get the name of the location.
     *
     * @return string
     */
    public function getName();

    /**
     * Set the first line of the street address.
     *
     * @param string $address1
     * @return self
     */
    public function setAddress1($address1);

    /**
     * Get the first line of the street address.
     *
     * @return string
     */
    public function getAddress1();

    /**
     * Set the second line of the street address.
     *
     * @param string $address2
     * @return self
     */
    public function setAddress2($address2);

    /**
     * Get the second line of the street address.
     *
     * @return string
     */
    public function getAddress2();

    /**
     * Set the city.
     *
     * @param string $city
     * @return self
     */
    public function setCity($city);

    /**
     * Get the city.
     *
     * @return string
     */
    public function getCity();

    /**
     * Set the state.
     *
     * @param string $state
     * @return self
     */
    public function setState($state);

    /**
     * Get the state.
     *
     * @return string
     */
    public function getState();

    /**
     * Set the postal code.
     *
     * @param string $postalCode
     * @return self
     */
    public function setPostalCode($postalCode);

    /**
     * Get the postal code.
     *
     * @return string
     */
    public function getPostalCode();

    /**
     * Set the country code.
     *
     * @param string $country
     * @return self
     */
    public function setCountry($country);

    /**
     * Get the country code.
     *
     * @return string
     */
    public function getCountry();

    /**
     * Set the contact name.
     *
     * @param string $name
     * @return self
     */
    public function setContactName($name);

    /**
     * Get the contact name.
     *
     * @return string
     */
    public function getContactName();

    /**
     * Set the contact phone number.
     *
     * @param string $phone
     * @return self
     */
    public function setContactPhone($phone);

    /**
     * Get the contact phone number.
     *
     * @return string
     */
    public function getContactPhone();

    /**
     * Set the contact email address.
     *
     * @param string $email
     * @return self
     */
    public function setContactEmail($email);

    /**
     * Get the contact email address.
     *
     * @return string
     */
    public function getContactEmail();
}