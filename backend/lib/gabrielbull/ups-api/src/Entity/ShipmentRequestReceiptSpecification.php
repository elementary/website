<?php
/*
 * Copyright © Eduard Sukharev
 *
 * For a license agreement, see the LICENSE file.
 */


namespace Ups\Entity;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class ShipmentRequestReceiptSpecification
{
    /**
     * Required.
     * Print code that determines the receipt format.
     * Valid Codes are: EPL, SPL, ZPL, STARPL and HTML.
     *
     * @var string
     */
    private $imageFormatCode;

    /**
     * Optional.
     * Description of the receipt format code.
     *
     * @var string
     */
    private $imageFormatDescription;

    const IMG_FORMAT_CODE_GIF = 'EPL';
    const IMG_FORMAT_CODE_SPL = 'SPL';
    const IMG_FORMAT_CODE_ZPL = 'ZPL';
    const IMG_FORMAT_CODE_STARPL = 'STARPL';
    const IMG_FORMAT_CODE_HTML = 'HTML';

    /**
     * @param string $imageFormatCode
     */
    public function __construct($imageFormatCode)
    {
        $this->imageFormatCode = $imageFormatCode;
    }

    /**
     * @return string
     */
    public function getImageFormatCode()
    {
        return $this->imageFormatCode;
    }
    /**
     * @return string
     */
    public function getImageFormatDescription()
    {
        return $this->imageFormatDescription;
    }

    /**
     * @param string $imageFormatDescription
     * @return ShipmentRequestReceiptSpecification
     */
    public function setImageFormatDescription($imageFormatDescription)
    {
        $this->imageFormatDescription = $imageFormatDescription;

        return $this;
    }
}
