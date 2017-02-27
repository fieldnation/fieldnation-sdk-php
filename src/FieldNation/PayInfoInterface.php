<?php
/**
 * @author Field Nation <support@fieldnation.com>
 * @license Apache 2.0
 * @copyright 2017 Field Nation
 */
namespace FieldNation;

interface PayInfoInterface
{
    /**
     * Set if pay info is fixed.
     *
     * @param FixedPayInterface $pay
     * @return self
     */
    public function setFixed(FixedPayInterface $pay);

    /**
     * Get the fixed pay info
     *
     * @return FixedPayInterface|NULL
     */
    public function getFixed();

    /**
     * Set if pay info is per hour.
     *
     * @param RatePayInterface $pay
     * @return self
     */
    public function setPerHour(RatePayInterface $pay);

    /**
     * Get the per hour pay info
     *
     * @return RatePayInterface|NULL
     */
    public function getPerHour();

    /**
     * Set if pay info is per hour.
     *
     * @param RatePayInterface $pay
     * @return self
     */
    public function setPerDevice(RatePayInterface $pay);

    /**
     * Get the per hour pay info
     *
     * @return RatePayInterface|NULL
     */
    public function getPerDevice();

    /**
     * Set if pay info is blended
     *
     * @param BlendedPayInterface $pay
     * @return self
     */
    public function setBlended(BlendedPayInterface $pay);

    /**
     * Get the blended pay info
     *
     * @return BlendedPayInterface|NULL
     */
    public function getBlended();
}
