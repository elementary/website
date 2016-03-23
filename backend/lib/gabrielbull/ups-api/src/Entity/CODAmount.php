<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class CODAmount implements NodeInterface
{
    public $CurrencyCode;
    public $MonetaryValue;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->CurrencyCode)) {
                $this->CurrencyCode = $response->CurrencyCode;
            }
            if (isset($response->MonetaryValue)) {
                $this->MonetaryValue = $response->MonetaryValue;
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
        $node = $document->createElement('CODAmount');
        if ($this->CurrencyCode) {
            $node->appendChild($document->createElement('CurrencyCode', $this->CurrencyCode));
        }
        if ($this->MonetaryValue) {
            $node->appendChild($document->createElement('MonetaryValue', $this->MonetaryValue));
        }
        return $node;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->CODCode;
    }

    /**
     * @param mixed $CurrencyCode
     * @return CODAmount
     */
    public function setCurrencyCode($CurrencyCode)
    {
        $this->CurrencyCode = $CurrencyCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMonetaryValue()
    {
        return $this->MonetaryValue;
    }

    /**
     * @param mixed $MonetaryValue
     * @return CODAmount
     */
    public function setMonetaryValue($MonetaryValue)
    {
        $this->MonetaryValue = $MonetaryValue;
        return $this;
    }
}
