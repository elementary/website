<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class AccessPointCOD
 * @package Ups\Entity
 */
class AccessPointCOD implements NodeInterface
{

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var float
     */
    private $monetaryValue;

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

        $node = $document->createElement('AccessPointCOD');

        $node->appendChild($document->createElement('CurrencyCode', $this->getCurrencyCode()));
        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));

        return $node;
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
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
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
     */
    public function setMonetaryValue($monetaryValue)
    {
        $this->monetaryValue = $monetaryValue;
    }
}
