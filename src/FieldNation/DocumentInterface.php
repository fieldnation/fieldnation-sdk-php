<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface DocumentInterface extends DescribableInterface, IdentifiableInterface
{
    /**
     * Set the pragmatic representation of the document.
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title);

    /**
     * Get the pragmatic representation of the document.
     * If the type is file, the file name will be returned. If the type is URL, the full URL will be returned.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set the pragmatic type of the document.
     *
     * @param $type
     * @return self
     */
    public function setType($type);

    /**
     * Get the pragmatic type of the document.
     * If the type is file, the MIME-type of the file will be returned (ex: "image/jpeg" for a JPEG image).
     * If the type is URL, "URL" will be returned.
     *
     * @return string
     */
    public function getType();

    /**
     * Set when the document was last updated.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setUpdatedTime($time);

    /**
     * Get when the document was last updated.
     *
     * @return \DateTime
     */
    public function getUpdatedTime();
}
