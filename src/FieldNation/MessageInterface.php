<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface MessageInterface
{
    /**
     * Set who the message is from.
     *
     * @param string $from
     * @return self
     */
    public function setFrom($from);

    /**
     * Get who the message is from.
     *
     * @return string
     */
    public function getFrom();

    /**
     * Set the type of user account the message is from.
     *
     * @param string $type
     * @return self
     */
    public function setFromType($type);

    /**
     * Get the type of user account the message is from.
     *
     * @return string
     */
    public function getFromType();

    /**
     * Set the date the message was posted.
     *
     * @param string $date
     * @return self
     */
    public function setDate($date);

    /**
     * Get the date the message was posted.
     *
     * @return string
     */
    public function getDate();

    /**
     * Set the contents of the message.
     *
     * @param string $message
     * @return self
     */
    public function setMessage($message);

    /**
     * Get the contents of the message.
     *
     * @return string
     */
    public function getMessage();

    /**
     * Set the message mode
     *
     * @param integer $mode
     * @throws \TypeError if $mode is not a constant that exists on MessageModes
     * @return self
     */
    public function setMode($mode);

    /**
     * Get the message mode
     *
     * @return integer
     */
    public function getMode();
}
