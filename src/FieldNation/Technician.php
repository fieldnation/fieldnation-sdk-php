<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class Technician implements TechnicianInterface
{
    private $id;
    private $firstName;
    private $lastName;
    private $city;
    private $state;
    private $postalCode;
    private $additionalFields;

    /**
     * Set the id
     *
     * @param integer $id
     * @return self
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the first name of the provider.
     *
     * @param $firstName
     * @return self
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get the first name of the provider.
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set the last name of the provider.
     *
     * @param $lastName
     * @return self
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get the last name of the provider
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set the city the provider primarily resides in.
     *
     * @param $city
     * @return self
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * Get the city the provider primarily resides in.
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set the state the provider primarily resides in.
     * @param $state
     * @return self
     */
    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    /**
     * Get the state the provider primarily resides in.
     * @return string
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set the postal code the provider primarily resides in.
     *
     * @param $postalCode
     * @return self
     */
    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
        return $this;

    }

    /**
     * Get the postal code the provider primarily resides in.
     *
     * @return string
     */
    public function getPostalCode() {
        return $this->postalCode;
    }

    /**
     * Set the additional data about the provider.
     *
     * @param AdditionalFieldInterface[] $additionalFields
     * @return self
     */
    public function setAdditionalFields($additionalFields) {
        $this->additionalFields = $additionalFields;
        return $this;
    }

    /**
     * Get the additional data about the provider.
     *
     * @return AdditionalFieldInterface[]
     */
    public function getAdditionalFields() {
        return $this->additionalFields;
    }
}