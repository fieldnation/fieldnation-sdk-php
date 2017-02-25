<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Label implements LabelInterface
{
    private $id;
    private $name;
    private $hideFromTech;
    private $techCanEdit;

    /**
     * Set the id
     *
     * @param integer $id
     * @return self
     */
    public function setId($id) {
        $this->id = $id;
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
     * Set the name of the label.
     *
     * @param string $name
     * @return self
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name of the label.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set if the label should be hidden from a provider.
     *
     * @param boolean $willHide
     * @return self
     */
    public function setHideFromTech($willHide) {
        $this->hideFromTech = $willHide;
        return $this;
    }

    /**
     * Get if the label should be hidden from a provider.
     *
     * @return boolean
     */
    public function hideFromTech() {
        return $this->hideFromTech;
    }

    /**
     * Set if a provider can remove a label.
     *
     * @param boolean $canEdit
     * @return self
     */
    public function setTechCanEdit($canEdit) {
        $this->techCanEdit = $canEdit;
        return $this;
    }

    /**
     * Get if a provider can remove a label.
     *
     * @return boolean
     */
    public function techCanEdit() {
        return $this->techCanEdit;
    }
}