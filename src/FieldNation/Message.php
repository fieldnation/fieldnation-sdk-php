<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class Message implements MessageInterface
{
    private $from;
    private $fromType;
    private $date;
    private $messageBody;
    private $mode;

    /**
     * Set who the message is from.
     *
     * @param string $from
     * @return self
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Get who the message is from.
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the type of user account the message is from.
     *
     * @param string $type
     * @return self
     */
    public function setFromType($type)
    {
        $this->fromType = $type;
        return $this;
    }

    /**
     * Get the type of user account the message is from.
     *
     * @return string
     */
    public function getFromType()
    {
        return $this->fromType;
    }

    /**
     * Set the date the message was posted.
     *
     * @param string $date
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get the date the message was posted.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the contents of the message.
     *
     * @param string $message
     * @return self
     */
    public function setMessage($message)
    {
        $this->messageBody = $message;
        return $this;
    }

    /**
     * Get the contents of the message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->messageBody;
    }

    /**
     * Set the message mode
     *
     * @param integer $mode
     * @throws \TypeError if $mode is not a constant that exists on MessageModes
     * @return self
     */
    public function setMode($mode)
    {
        $modes = MessageModes::getConstants();
        if (!in_array($mode, $modes)) {
            throw new \TypeError('Message Mode '. $mode .' is not recognized.');
        }

        $this->mode = $mode;
        return $this;
    }

    /**
     * Get the message mode
     *
     * @return integer
     */
    public function getMode()
    {
        return $this->mode;
    }
}
