<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Project implements ProjectInterface
{
    private $client;
    private $id;
    private $enabled;
    private $name;
    private $templates;
    private $managers;
    private $customFields;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

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
     * Set if the project is currently enabled.
     *
     * @param boolean $isEnabled
     * @return self
     */
    public function setIsEnabled($isEnabled) {
        $this->enabled = (boolean)$isEnabled;
        return $this;
    }

    /**
     * Check if the project is enabled.
     *
     * @return boolean
     */
    public function isEnabled() {
        return $this->enabled;
    }

    /**
     * Set project name
     *
     * @param string $name
     * @return self
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the project name.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the templates associated with this project.
     *
     * @param TemplateInterface[] $templates
     * @return self
     */
    public function setTemplates($templates) {
        $this->templates = $templates;
        return $this;
    }

    /**
     * Get the templates associated with this project.
     *
     * @return TemplateInterface[]
     */
    public function getTemplates() {
        return $this->templates;
    }

    /**
     * Set the managers for the project.
     * @param UserInterface[] $managers
     * @return self
     */
    public function setManagers($managers) {
        $this->managers = $managers;
        return $this;
    }

    /**
     * Get the managers for the project.
     *
     * @return UserInterface[]
     */
    public function getManagers() {
        return $this->managers;
    }

    /**
     * Get the details of a project
     *
     * @see https://app.fieldnation.com/docs/soap/getProjectDetails
     * @return ProjectInterface
     */
    public function getDetails() {
        return $this->client->getProject($this->getId());
    }

    /**
     * Set the custom fields.
     *
     * @param CustomFieldInterface[] $fields
     * @return self
     */
    public function setCustomFields($fields) {
        $this->customFields = $fields;
        return $this;
    }

    /**
     * @return CustomFieldInterface[]
     */
    public function getCustomFields() {
        return $this->customFields;
    }
}
