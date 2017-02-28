<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Template implements TemplateInterface
{
    private $id;
    private $description;

    /**
     * Set the id
     *
     * @param integer $id
     * @return self
     */
    public function setId($id) {
        $this->id = (integer)$id;
        return $this;
    }

    /**
     * Get the id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
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
