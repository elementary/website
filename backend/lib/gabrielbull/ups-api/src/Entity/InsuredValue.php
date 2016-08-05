<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class InsuredValue implements NodeInterface
{
    /** @deprecated */
    public $CurrencyCode;
    /** @deprecated */
    public $MonetaryValue;

    /**
     * @var string
     */
    private $currencyCode;

    /**
     * @var float
     */
    private $monetaryValue;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->CurrencyCode)) {
                $this->setCurrencyCode($response->CurrencyCode);
            }
            if (isset($response->MonetaryValue)) {
                $this->setMonetaryValue($response->MonetaryValue);
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

        $node = $document->createElement('InsuredValue');
        $node->appendChild($document->createElement('CurrencyCode', $this->getCurrencyCode()));
        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));

        return $node;
    }

    /**
     * @return string|null
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param $var string
     */
    public function setCurrencyCode($var)
    {
        $this->CurrencyCode = $var;
        $this->currencyCode = $var;
    }

    /**
     * @return float|null
     */
    public function getMonetaryValue()
    {
        return $this->monetaryValue;
    }

    /**
     * @param $var float
     */
    public function setMonetaryValue($var)
    {
        $this->MonetaryValue = $var;
        $this->monetaryValue = $var;
    }
}
