<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface LabelInterface extends IdentifiableInterface
{
    /**
     * Set the name of the label.
     *
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * Get the name of the label.
     *
     * @return string
     */
    public function getName();

    /**
     * Set if the label should be hidden from a provider.
     *
     * @param boolean $willHide
     * @return self
     */
    public function setHideFromTech($willHide);

    /**
     * Get if the label should be hidden from a provider.
     *
     * @return boolean
     */
    public function hideFromTech();

    /**
     * Set if a provider can remove a label.
     *
     * @param boolean $canEdit
     * @return self
     */
    public function setTechCanEdit($canEdit);

    /**
     * Get if a provider can remove a label.
     *
     * @return boolean
     */
    public function techCanEdit();
}
