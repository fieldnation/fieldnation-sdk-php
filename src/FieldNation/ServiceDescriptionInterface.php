<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface ServiceDescriptionInterface extends DescribableInterface
{
    /**
     * Set the category id
     *
     * @param integer $categoryId
     * @return self
     */
    public function setCategoryId($categoryId);

    /**
     * Get the category id
     *
     * @return integer
     */
    public function getCategoryId();

    /**
     * Set the title.
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title);

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set any confidential information that should only be shown to the provider who is assigned.
     *
     * @param string $instruction
     * @return self
     */
    public function setInstruction($instruction);

    /**
     * Get any confidential information that should only be shown to the provider who is assigned.
     *
     * @return string
     */
    public function getInstruction();
}