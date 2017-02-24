<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface ProjectInterface extends IdentifiableInterface
{
    /**
     * Set if the project is currently enabled.
     *
     * @param boolean $isEnabled
     * @return self
     */
    public function setIsEnabled($isEnabled);

    /**
     * Check if the project is enabled.
     *
     * @return boolean
     */
    public function isEnabled();

    /**
     * Set project name
     *
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * Get the project name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set the templates associated with this project.
     *
     * @param TemplateInterface[] $templates
     * @return self
     */
    public function setTemplates($templates);

    /**
     * Get the templates associated with this project.
     *
     * @return TemplateInterface[]
     */
    public function getTemplates();

    /**
     * Set the managers for the project.
     * @param UserInterface[] $managers
     * @return self
     */
    public function setManagers($managers);

    /**
     * Get the managers for the project.
     *
     * @return UserInterface[]
     */
    public function getManagers();

    /**
     * Get the details of a project
     *
     * @see https://app.fieldnation.com/docs/soap/getProjectDetails
     * @return ProjectInterface
     */
    public function getDetails();

    /**
     * Set the custom fields.
     *
     * @param CustomFieldInterface[] $fields
     * @return self
     */
    public function setCustomFields($fields);

    /**
     * @return CustomFieldInterface[]
     */
    public function getCustomFields();
}