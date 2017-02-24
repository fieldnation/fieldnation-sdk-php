<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface HistoryInterface extends DescribableInterface
{
    /**
     * Set the entry date
     * @param \DateTime $date
     * @return self
     */
    public function setEntryDate($date);

    /**
     * Get the entry date.
     * @return \DateTime
     */
    public function getEntryDate();
}