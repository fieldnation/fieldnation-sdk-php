<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface ResultInterface
{
    /**
     * Was the request successful?
     *
     * @return boolean
     */
    public function wasSuccessful();

    /**
     * A message that explains the success or failure.
     *
     * @return string
     */
    public function getMessage();

    /**
     * Get to work order id, if applicable.
     *
     * @return integer|NULL
     */
    public function getWorkOrderId();
}