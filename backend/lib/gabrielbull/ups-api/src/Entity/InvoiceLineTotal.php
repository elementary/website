<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class InvoiceLineTotal implements NodeInterface
{
    private $currencyCode;
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

        $node = $document->createElement('InvoiceLineTotal');

        if ($this->getCurrencyCode()) {
            $node->appendChild($document->createElement('CurrencyCode', $this->getCurrencyCode()));
        }

        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));

        return $node;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode($var)
    {
        $this->currencyCode = $var;
    }

    public function getMonetaryValue()
    {
        return $this->monetaryValue;
    }

    public function setMonetaryValue($var)
    {
        if (!is_numeric($var)) {
            throw new \Exception('Monetary value should be a numeric value');
        }

        $this->monetaryValue = $var;
    }
}
