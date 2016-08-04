<?php

namespace Ups\Entity\Tradeability;

use DOMDocument;
use DOMElement;

class FreightCharges extends \Ups\Entity\FreightCharges
{
    private $currencyCode;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->CurrencyCode)) {
                $this->setCurrencyCode($response->CurrencyCode);
            }
        }

        parent::__construct($response);
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

        $node = $document->createElement('FreightCharges');
        $node->appendChild($document->createElement('MonetaryValue', $this->getMonetaryValue()));
        $node->appendChild($document->createElement('CurrencyCode', $this->getCurrencyCode()));

        return $node;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param mixed $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }
}
