<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface TechnicianInterface extends IdentifiableInterface
{
    /**
     * Set the first name of the provider.
     *
     * @param $firstName
     * @return self
     */
    public function setFirstName($firstName);

    /**
     * Get the first name of the provider.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Set the last name of the provider.
     *
     * @param $lastName
     * @return self
     */
    public function setLastName($lastName);

    /**
     * Get the last name of the provider
     *
     * @return string
     */
    public function getLastName();

    /**
     * Set the city the provider primarily resides in.
     *
     * @param $city
     * @return self
     */
    public function setCity($city);

    /**
     * Get the city the provider primarily resides in.
     * @return string
     */
    public function getCity();

    /**
     * Set the state the provider primarily resides in.
     * @param $state
     * @return self
     */
    public function setState($state);

    /**
     * Get the state the provider primarily resides in.
     * @return string
     */
    public function getState();

    /**
     * Set the postal code the provider primarily resides in.
     *
     * @param $postalCode
     * @return self
     */
    public function setPostalCode($postalCode);

    /**
     * Get the postal code the provider primarily resides in.
     *
     * @return string
     */
    public function getPostalCode();

    /**
     * Set the additional data about the provider.
     *
     * @param AdditionalFieldInterface[] $additionalFields
     * @return self
     */
    public function setAdditionalFields($additionalFields);

    /**
     * Get the additional data about the provider.
     *
     * @return AdditionalFieldInterface[]
     */
    public function getAdditionalFields();
}
