<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class CloseoutRequirement implements CloseoutRequirementInterface
{
    private $name;
    private $description;
    private $order;

    /**
     * Set name of the closeout requirement, with only alphanumeric characters and no spaces.
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

    /**
     * Set the order to display the results in the system; this does not enforce an order of completion.
     *
     * @param integer $order
     * @return self
     */
    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }

    /**
     * Get the order
     *
     * @return integer
     */
    public function getOrder() {
        return $this->order;
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