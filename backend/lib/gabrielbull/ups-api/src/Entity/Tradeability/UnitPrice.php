<?php

namespace Ups\Entity\Tradeability;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class UnitPrice.
 */
class UnitPrice implements NodeInterface
{

    /**
     * @var float
     */
    private $monetaryValue;

    /**
     * @var string
     */
    private $currencyCode;

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

        $node = $document->createElement('UnitPrice');

        // Required
        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));

        // Optional
        if ($this->getCurrencyCode() !== null) {
            $node->appendChild($document->createElement('CurrencyCode', $this->getCurrencyCode()));
        }

        return $node;
    }

    /**
     * @return float
     */
    public function getMonetaryValue()
    {
        return $this->monetaryValue;
    }

    /**
     * @param float $monetaryValue
     * @return UnitPrice
     */
    public function setMonetaryValue($monetaryValue)
    {
        $this->monetaryValue = $monetaryValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     * @return UnitPrice
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }
}
