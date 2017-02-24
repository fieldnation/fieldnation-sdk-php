<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface ProblemInterface extends DescribableInterface, IdentifiableInterface
{
    /**
     * Set the reporting user.
     *
     * @param string $name
     * @return self
     */
    public function setReportedBy($name);

    /**
     * Get the reporting user.
     *
     * @return string
     */
    public function getReportedBy();

    /**
     * Set the reported time.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setReportedTime($time);

    /**
     * Get the reported time.
     *
     * @return \DateTime
     */
    public function getReportedTime();

    /**
     * Set if assistance is required.
     *
     * @param boolean $isRequired
     * @return self
     */
    public function setIsAssistanceRequired($isRequired);

    /**
     * Check is assistance is required.
     *
     * @return boolean
     */
    public function isAssistanceRequired();

    /**
     * Set if problem is resolved.
     *
     * @param boolean $isResolved
     * @return self
     */
    public function setIsResolved($isResolved);

    /**
     * Check if the problem is resolved.
     *
     * @return boolean
     */
    public function isResolved();

    /**
     * Set when the problem was resolved.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setResolvedTime($time);

    /**
     * Get when the problem was resolved.
     *
     * @return \DateTime
     */
    public function getResolvedTime();

    /**
     * Set who resolved the problem.
     *
     * @param string $name
     * @return self
     */
    public function setResolvedBy($name);

    /**
     * Get who resolved the problem.
     *
     * @return string
     */
    public function getResolvedBy();
}