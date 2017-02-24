<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


interface RecipientInterface extends IdentifiableInterface
{
    /**
     * Check if a recipient is a provider
     *
     * @return boolean
     */
    public function isProvider();

    /**
     * Check if a recipient is a group
     *
     * @return boolean
     */
    public function isGroup();
}