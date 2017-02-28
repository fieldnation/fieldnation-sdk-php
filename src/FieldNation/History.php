<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

class History implements HistoryInterface
{
    private $date;
    private $description;

    /**
     * Set the entry date
     * @param \DateTime $date
     * @return self
     */
    public function setEntryDate($date) {
        $this->date = $date;
        return $this;
    }

    /**
     * Get the entry date.
     * @return \DateTime
     */
    public function getEntryDate() {
        return $this->date;
    }

    /**
     * Set the description.
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }
}
