<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

abstract class AbstractUser implements UserInterface
{
    protected $id;
    protected $fullName;

    /**
     * Set the ID for a user.
     *
     * @param integer $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the user ID.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

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
