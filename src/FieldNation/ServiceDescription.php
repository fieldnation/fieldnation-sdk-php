<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class ServiceDescription implements ServiceDescriptionInterface
{
    private $categoryId;
    private $title;
    private $instruction;
    private $description;

    /**
     * Set the category id
     *
     * @param integer $categoryId
     * @return self
     */
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * Get the category id
     *
     * @return integer
     */
    public function getCategoryId() {
        return $this->categoryId;
    }

    /**
     * Set the title.
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set any confidential information that should only be shown to the provider who is assigned.
     *
     * @param string $instruction
     * @return self
     */
    public function setInstruction($instruction) {
        $this->instruction = $instruction;
        return $this;
    }

    /**
     * Get any confidential information that should only be shown to the provider who is assigned.
     *
     * @return string
     */
    public function getInstruction() {
        return $this->instruction;
    }

    /**
     * Set the description.
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }
}