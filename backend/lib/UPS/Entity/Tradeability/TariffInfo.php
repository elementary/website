<?php

namespace Ups\Entity\Tradeability;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class TariffInfo.
 */
class TariffInfo implements NodeInterface
{

    /**
     * @var string
     * @required
     */
    private $tariffCode;

    /**
     * @var string
     * @optional
     */
    private $detailId;

    /**
     * @var string
     * @optional
     */
    private $secondaryTariffCode;

    /**
     * @var string
     * @optional
     */
    private $secondaryDetailId;

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('TariffInfo');

        // Required
        $node->appendChild($document->createElement('TariffCode', $this->getTariffCode()));

        // Optional
        if ($this->getDetailId() !== null) {
            $node->appendChild($document->createElement('DetailId', $this->getDetailId()));
        }
        if ($this->getSecondaryTariffCode() !== null) {
            $node->appendChild($document->createElement('SecondaryTariffCode', $this->getSecondaryTariffCode()));
        }
        if ($this->getSecondaryDetailId() !== null) {
            $node->appendChild($document->createElement('SecondaryDetailId', $this->getSecondaryDetailId()));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getTariffCode()
    {
        return $this->tariffCode;
    }

    /**
     * @param string $tariffCode
     * @return TariffInfo
     */
    public function setTariffCode($tariffCode)
    {
        $this->tariffCode = $tariffCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getDetailId()
    {
        return $this->detailId;
    }

    /**
     * @param string $detailId
     * @return TariffInfo
     */
    public function setDetailId($detailId)
    {
        $this->detailId = $detailId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryTariffCode()
    {
        return $this->secondaryTariffCode;
    }

    /**
     * @param string $secondaryTariffCode
     * @return TariffInfo
     */
    public function setSecondaryTariffCode($secondaryTariffCode)
    {
        $this->secondaryTariffCode = $secondaryTariffCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getSecondaryDetailId()
    {
        return $this->secondaryDetailId;
    }

    /**
     * @param string $secondaryDetailId
     * @return TariffInfo
     */
    public function setSecondaryDetailId($secondaryDetailId)
    {
        $this->secondaryDetailId = $secondaryDetailId;

        return $this;
    }
}
