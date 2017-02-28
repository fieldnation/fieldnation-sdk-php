<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface CustomFieldInterface extends IdentifiableInterface
{
    /**
     * Set the name
     *
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * Get the name
     *
     * @return string
     */
    public function getName();

}
