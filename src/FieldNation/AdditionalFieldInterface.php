<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface AdditionalFieldInterface
{
    /**
     * Set the name of the field.
     *
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * Get the name of the field.
     *
     * @return string
     */
    public function getName();

    /**
     * Set the value of the field.
     *
     * @param string $value
     * @return self
     */
    public function setValue($value);

    /**
     * Get the value of the field.
     *
     * @return string
     */
    public function getValue();
}
