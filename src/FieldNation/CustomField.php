<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class CustomField implements CustomFieldInterface
{
    private $id;
    private $name;
    
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
     * Set the name
     *
     * @param string $name
     * @return self
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }
}
