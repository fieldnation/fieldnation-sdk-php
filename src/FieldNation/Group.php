<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Group implements GroupInterface
{
    use IdentifiableTrait;

    private $name;
    private $count;

    /**
     * Set the name of the group.
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
     * Get the name of the group.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the number of individuals in the group.
     *
     * @param integer $count
     * @return self
     */
    public function setCount($count)
    {
        $this->count = (integer)$count;
        return $this;
    }

    /**
     * Get the number of individuals in the group.
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }
}
