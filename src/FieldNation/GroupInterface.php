<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface GroupInterface extends IdentifiableInterface
{
    /**
     * Set the name of the group.
     *
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * Get the name of the group.
     *
     * @return string
     */
    public function getName();

    /**
     * Set the number of individuals in the group.
     *
     * @param integer $count
     * @return self
     */
    public function setCount($count);

    /**
     * Get the number of individuals in the group.
     * @return integer
     */
    public function getCount();
}
