<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class Product.
 */
class Product implements NodeInterface
{
    /**
     * @var string
     */
    private $description1;

    /**
     * @var string
     */
    private $description2;

    /**
     * @var string
     */
    private $description3;

    /**
     * @var string
     */
    private $commodityCode;

    /**
     * @var string
     */
    private $partNumber;

    /**
     * @var string
     */
    private $originCountryCode;

    /**
     * @var Unit
     */
    private $unit;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Description)) {
                $this->setDescription1($attributes->Description);
            }
            if (isset($attributes->CommodityCode)) {
                $this->setCommodityCode($attributes->CommodityCode);
            }
            if (isset($attributes->PartNumber)) {
                $this->setPartNumber($attributes->PartNumber);
            }
            if (isset($attributes->OriginCountryCode)) {
                $this->setOriginCountryCode($attributes->OriginCountryCode);
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

        $node = $document->createElement('Product');
        for ($i = 1; $i <= 3; $i++) {
            $desc = $this->{'getDescription' . $i}();
            if ($desc !== null) {
                $node->appendChild($document->createElement('Description', $desc));
            }
        }
        $node->appendChild($this->getUnit()->toNode($document));
        if ($this->getCommodityCode() !== null) {
            $node->appendChild($document->createElement('CommodityCode', $this->getCommodityCode()));
        }
        if ($this->getPartNumber() !== null) {
            $node->appendChild($document->createElement('PartNumber', $this->getPartNumber()));
        }
        if ($this->getOriginCountryCode() !== null) {
            $node->appendChild($document->createElement('OriginCountryCode', $this->getOriginCountryCode()));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getDescription1()
    {
        return $this->description1;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription1($description)
    {
        if (strlen($description) > 35) {
            $description = substr($description, 0, 35);
        }

        $this->description1 = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription2($description)
    {
        if (strlen($description) > 35) {
            $description = substr($description, 0, 35);
        }

        $this->description2 = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription3()
    {
        return $this->description3;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription3($description)
    {
        if (strlen($description) > 35) {
            $description = substr($description, 0, 35);
        }

        $this->description3 = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getCommodityCode()
    {
        return $this->commodityCode;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCommodityCode($code)
    {
        $this->commodityCode = $code;

        return $this;
    }

    /**
     * @param Unit $unit
     *
     * @return $this
     */
    public function setUnit(Unit $unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param $number
     *
     * @return $this
     */
    public function setPartNumber($number)
    {
        $this->partNumber = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getPartNumber()
    {
        return $this->partNumber;
    }

    /**
     * @param string $countryCode
     *
     * @return $this
     */
    public function setOriginCountryCode($countryCode)
    {
        $this->originCountryCode = $countryCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getOriginCountryCode()
    {
        return $this->originCountryCode;
    }
}
