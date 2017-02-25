<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class AdditionalField implements  AdditionalFieldInterface
{
    private $name;
    private $value;

    /**
     * Set the name of the field.
     *
     * @param string $name
     * @return self
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name of the field.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value of the field.
     *
     * @param string $value
     * @return self
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    /**
     * Get the value of the field.
     *
     * @return string
     */
    public function getValue() {
        return $this->value;
    }
}