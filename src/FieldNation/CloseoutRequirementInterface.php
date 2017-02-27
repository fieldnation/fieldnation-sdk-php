<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface CloseoutRequirementInterface extends DescribableInterface
{
    /**
     * Set name of the closeout requirement, with only alphanumeric characters and no spaces.
     *
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * Get the name
     *
     * @return string
     */
    public function getName();

    /**
     * Set the order to display the results in the system; this does not enforce an order of completion.
     *
     * @param integer $order
     * @return self
     */
    public function setOrder($order);

    /**
     * Get the order
     *
     * @return integer
     */
    public function getOrder();
}