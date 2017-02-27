<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface IdentifiableInterface
{
    /**
     * Set the id
     *
     * @param integer $id
     * @return self
     */
    public function setId($id);

    /**
     * Get the id
     *
     * @return integer
     */
    public function getId();
}
