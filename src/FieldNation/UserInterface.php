<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface UserInterface extends IdentifiableInterface
{
    /**
     * Set the full name for the user.
     *
     * @param string $name
     * @return self
     */
    public function setFullName($name);

    /**
     * Get the full name for the user.
     *
     * @return string
     */
    public function getFullName();
}
