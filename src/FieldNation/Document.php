<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Document implements DocumentInterface
{
    private $id;
    private $title;
    private $description;
    private $type;
    private $updatedTime;

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
     * Set the pragmatic representation of the document.
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the pragmatic representation of the document.
     * If the type is file, the file name will be returned. If the type is URL, the full URL will be returned.
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
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

    /**
     * Set the pragmatic type of the document.
     *
     * @param $type
     * @return self
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the pragmatic type of the document.
     * If the type is file, the MIME-type of the file will be returned (ex: "image/jpeg" for a JPEG image).
     * If the type is URL, "URL" will be returned.
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set when the document was last updated.
     *
     * @param \DateTime $time
     * @return self
     */
    public function setUpdatedTime($time) {
        $this->updatedTime = $time;
        return $this;
    }

    /**
     * Get when the document was last updated.
     *
     * @return \DateTime
     */
    public function getUpdatedTime() {
        return $this->updatedTime;
    }
}
