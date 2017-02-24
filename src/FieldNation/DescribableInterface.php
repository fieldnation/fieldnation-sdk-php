<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface DescribableInterface
{
    /**
     * Set the description.
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description);

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();
}