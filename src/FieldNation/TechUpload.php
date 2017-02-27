<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class TechUpload implements TechUploadInterface
{
    private $name;
    private $size;
    private $url;

    /**
     * Set the file name of the upload.
     *
     * @param string $name
     * @return self
     */
    public function setFileName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the file name of the upload.
     *
     * @return string
     */
    public function getFileName() {
        return $this->name;
    }

    /**
     * Set the size of the uploaded file.
     *
     * @param integer $size
     * @return self
     */
    public function setFileSize($size) {
        $this->size = (integer)$size;
        return $this;
    }

    /**
     * Get the size of the uploaded file.
     *
     * @return integer
     */
    public function getFileSize() {
        return $this->name;
    }

    /**
     * Set the download url.
     *
     * @param string $url
     * @return self
     */
    public function setDownloadUrl($url) {
        $this->url = $url;
        return $this;
    }

    /**
     * Get the download url.
     *
     * @return string
     */
    public function getDownloadUrl() {
        return $this->url;
    }
}