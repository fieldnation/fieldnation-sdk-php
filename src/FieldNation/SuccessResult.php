<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class SuccessResult extends Result
{
    public function __construct($message = null)
    {
        $this->setSuccessful(true);
        $this->setMessage($message);
    }

    /**
     * Was the request successful?
     *
     * @return boolean
     */
    public function wasSuccessful()
    {
        return $this->success;
    }
}
