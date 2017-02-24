<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface TechUploadInterface
{
    /**
     * Set the file name of the upload.
     *
     * @param string $name
     * @return self
     */
    public function setFileName($name);

    /**
     * Get the file name of the upload.
     *
     * @return string
     */
    public function getFileName();

    /**
     * Set the size of the uploaded file.
     *
     * @param integer $size
     * @return self
     */
    public function setFileSize($size);

    /**
     * Get the size of the uploaded file.
     *
     * @return integer
     */
    public function getFileSize();

    /**
     * Set the download url.
     *
     * @param string $url
     * @return self
     */
    public function setDownloadUrl($url);

    /**
     * Get the download url.
     *
     * @return string
     */
    public function getDownloadUrl();
}