<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

abstract class AbstractUser implements UserInterface
{
    use IdentifiableTrait;

    protected $fullName;

    /**
     * Set the full name for the user.
     *
     * @param string $name
     * @return self
     */
    public function setFullName($name)
    {
        $this->fullName = $name;
        return $this;
    }

    /**
     * Get the full name for the user.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }
}
