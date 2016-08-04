<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ShipperFiled implements NodeInterface
{
    const SF_ITN                   = 'A';  // Requires the ITN
    const SF_EXEMPTION_LEGEND      = 'B';  // Requires the Exemption Legend
    const SF_POST_DEPARTURE_FILING = 'C';  // Requires Post Departure Filing Citation

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     * Required if code=SF_ITN
     */
    private $preDepartureITNNumber;

    /**
     * @var string
     * Required if code=SF_EXEMPTION_LEGEND
     */
    private $exemptionLegend;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Code)) {
                $this->setCode($attributes->Code);
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
            }
            if (isset($attributes->PreDepartureITNNumber)) {
                $this->setPreDepartureITNNumber($attributes->PreDepartureITNNumber);
            }
            if (isset($attributes->ExemptionLegend)) {
                $this->setExemptionLegend($attributes->ExemptionLegend);
            }
        }
    }

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

        $node = $document->createElement('ShipperFiled');

        $code = $this->getCode();
        if (isset($code)) {
            $node->appendChild($document->createElement('Code', $code));
        }

        $description = $this->getDescription();
        if (isset($description)) {
            $node->appendChild($document->createElement('Description', $description));
        }

        $preDepartureITNNumber = $this->getPreDepartureITNNumber();
        if (isset($code)) {
            $node->appendChild($document->createElement('PreDepartureITNNumber', $preDepartureITNNumber));
        }

        $exemptionLegend = $this->getExemptionLegend();
        if (isset($exemptionLegend)) {
            $node->appendChild($document->createElement('ExemptionLegend', $exemptionLegend));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getPreDepartureITNNumber()
    {
        return $this->preDepartureITNNumber;
    }

    /**
     * @param string $preDepartureITNNumber
     *
     * @return $this
     */
    public function setPreDepartureITNNumber($preDepartureITNNumber)
    {
        $this->preDepartureITNNumber = $preDepartureITNNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getExemptionLegend()
    {
        return $this->exemptionLegend;
    }

    /**
     * @return string $exemptionLegend
     */
    public function setExemptionLegend($exemptionLegend)
    {
        $this->exemptionLegend = $exemptionLegend;

        return $this;
    }
}
