<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class SuccessResult extends Result
{
    /**
     * Was the request successful?
     *
     * @return boolean
     */
    public function wasSuccessful()
    {
        return true;
    }
}
