<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;


class PayInfo implements PayInfoInterface
{
    private $fixed;
    private $perHour;
    private $perDevice;
    private $blended;

    /**
     * Set if pay info is fixed.
     *
     * @param FixedPayInterface $pay
     * @return self
     */
    public function setFixed(FixedPayInterface $pay) {
        $this->fixed = $pay;
        return $this;
    }

    /**
     * Get the fixed pay info
     *
     * @return FixedPayInterface|NULL
     */
    public function getFixed() {
        return $this->fixed;
    }

    /**
     * Set if pay info is per hour.
     *
     * @param RatePayInterface $pay
     * @return self
     */
    public function setPerHour(RatePayInterface $pay) {
        $this->perHour = $pay;
        return $this;
    }

    /**
     * Get the per hour pay info
     *
     * @return RatePayInterface|NULL
     */
    public function getPerHour() {
        return $this->perHour;
    }

    /**
     * Set if pay info is per hour.
     *
     * @param RatePayInterface $pay
     * @return self
     */
    public function setPerDevice(RatePayInterface $pay) {
        $this->perDevice = $pay;
        return $this;
    }

    /**
     * Get the per hour pay info
     *
     * @return RatePayInterface|NULL
     */
    public function getPerDevice() {
        return $this->perDevice;
    }

    /**
     * Set if pay info is blended
     *
     * @param BlendedPayInterface $pay
     * @return self
     */
    public function setBlended(BlendedPayInterface $pay) {
        $this->blended = $pay;
        return $this;
    }

    /**
     * Get the blended pay info
     *
     * @return BlendedPayInterface|NULL
     */
    public function getBlended() {
        return $this->blended;
    }
}