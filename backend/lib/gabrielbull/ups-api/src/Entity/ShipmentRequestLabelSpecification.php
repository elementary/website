<?php
/*
 * Copyright © Eduard Sukharev
 *
 * For a license agreement, see the LICENSE file.
 */


namespace Ups\Entity;

/**
 * Based on UPS Developer Guide, dated: 13 Jul 2015
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class ShipmentRequestLabelSpecification
{
    /**
     * Required.
     * Label print method code that the labels are to be generated. For EPL2 formatted labels use EPL, for SPL formatted
     * labels use SPL, for ZPL formatted labels use ZPL, for STAR printer formatted labels use STARPL and for image
     * formats use GIF.
     *
     * @var string
     */
    private $printMethodCode;

    /**
     * Optional.
     * Label Specification Code description
     *
     * @var string
     */
    private $printMethodDescription;

    /**
     * Optional.
     * Browser HTTPUserAgent String. This is the preferred way of identifying GIF image type to be generated
     *
     * @var string
     */
    private $httpUserAgent;

    /**
     * Required for EPL2, ZPL, STARPL and SPL labels.
     * Height of the label image. For IN, use whole inches. Only valid value is 4.
     * Label Image will only scale up to 4 X 6, even when requesting 4 X 8.
     *
     * @var string
     */
    private $stockSizeHeight;

    /**
     * Required for EPL2, ZPL, STARPL and SPL labels.
     * Height of the label image. For IN, use whole inches. Only valid values are 6 or 8.
     * Label Image will only scale up to 4 X 6, even when requesting 4 X 8.
     *
     * @var string
     */
    private $stockSizeWidth;

    /**
     * Required if $printMethodCode = GIF.
     * Code type that the label image is to be generated in.
     * Valid values are GIF or PNG. Only GIF is supported on the remote server.
     *
     * @var string
     */
    private $imageFormatCode;

    /**
     * Optional.
     * Description of the label image format code.
     *
     * @var string
     */
    private $imageFormatDescription;

    /**
     * Optional.
     * For Exchange Forward Shipment, Valid values are:
     * 01 - EXCHANGE-LIKE ITEM ONLY.
     * 02 - EXCHANGE-DRIVER INSTRUCTIONS INSIDE
     * By default label will have Exchange Routing instruction Text as EXCHANGE-LIKE ITEM ONLY
     *
     * @var string
     */
    private $instructionCode;

    /**
     * Optional.
     * Description of the label Instruction code.
     *
     * @var string
     */
    private $instructionDescription;

    const PRINT_METHOD_CODE_EPL = 'EPL';
    const PRINT_METHOD_CODE_SPL = 'SPL';
    const PRINT_METHOD_CODE_ZPL = 'ZPL';
    const PRINT_METHOD_CODE_STARPL = 'STARPL';
    const PRINT_METHOD_CODE_GIF = 'GIF';

    const IMG_FORMAT_CODE_GIF = 'GIF';
    const IMG_FORMAT_CODE_PNG = 'PNG';

    const INSTRUCTION_CODE_EXCHANGE_LIKE_ITEM_ONLY = '01';
    const INSTRUCTION_CODE_EXCHANGE_DRIVER_INSTRUCTIONS_INSIDE = '02';

    /**
     * @param string $printMethodCode
     */
    public function __construct($printMethodCode)
    {
        $this->printMethodCode = $printMethodCode;
    }

    /**
     * @return string
     */
    public function getPrintMethodCode()
    {
        return $this->printMethodCode;
    }

    /**
     * @return string
     */
    public function getPrintMethodDescription()
    {
        return $this->printMethodDescription;
    }

    /**
     * @param string $printMethodDescription
     * @return ShipmentRequestLabelSpecification
     */
    public function setPrintMethodDescription($printMethodDescription)
    {
        $this->printMethodDescription = $printMethodDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getHttpUserAgent()
    {
        return $this->httpUserAgent;
    }

    /**
     * @param string $httpUserAgent
     * @return ShipmentRequestLabelSpecification
     */
    public function setHttpUserAgent($httpUserAgent)
    {
        $this->httpUserAgent = $httpUserAgent;

        return $this;
    }

    /**
     * @return string
     */
    public function getStockSizeHeight()
    {
        return $this->stockSizeHeight;
    }

    /**
     * @param string $stockSizeHeight
     * @return ShipmentRequestLabelSpecification
     */
    public function setStockSizeHeight($stockSizeHeight)
    {
        $this->stockSizeHeight = $stockSizeHeight;

        return $this;
    }

    /**
     * @return string
     */
    public function getStockSizeWidth()
    {
        return $this->stockSizeWidth;
    }

    /**
     * @param string $stockSizeWidth
     * @return ShipmentRequestLabelSpecification
     */
    public function setStockSizeWidth($stockSizeWidth)
    {
        $this->stockSizeWidth = $stockSizeWidth;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageFormatCode()
    {
        return $this->imageFormatCode;
    }

    /**
     * @param string $imageFormatCode
     * @return ShipmentRequestLabelSpecification
     */
    public function setImageFormatCode($imageFormatCode)
    {
        $this->imageFormatCode = $imageFormatCode;

        return $this;
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
     * @return ShipmentRequestLabelSpecification
     */
    public function setImageFormatDescription($imageFormatDescription)
    {
        $this->imageFormatDescription = $imageFormatDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getInstructionCode()
    {
        return $this->instructionCode;
    }

    /**
     * @param string $instructionCode
     * @return ShipmentRequestLabelSpecification
     */
    public function setInstructionCode($instructionCode)
    {
        $this->instructionCode = $instructionCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getInstructionDescription()
    {
        return $this->instructionDescription;
    }

    /**
     * @param string $instructionDescription
     * @return ShipmentRequestLabelSpecification
     */
    public function setInstructionDescription($instructionDescription)
    {
        $this->instructionDescription = $instructionDescription;

        return $this;
    }
}
