<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright {YEAR} Field Nation
 */
namespace FieldNation;

class FailureResult extends Result
{
    public function __construct($message = null)
    {
        $this->setSuccessful(false);
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
