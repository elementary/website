<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class COD implements NodeInterface
{
    public $CODCode;
    public $CODFundsCode;
    public $CODAmount;

    public function __construct($response = null)
    {
        $this->CODAmount = new CODAmount();

        if (null != $response) {
            if (isset($response->CODCode)) {
                $this->CODCode = $response->CODCode;
            }
            if (isset($response->CODFundsCode)) {
                $this->CODFundsCode = $response->CODFundsCode;
            }
            if (isset($response->CODAmount)) {
                $this->CODAmount = new CODAmount($response->CODAmount);
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

        $node = $document->createElement('COD');

        if ($this->getCODCode()) {
            $node->appendChild($document->createElement('CODCode', $this->getCODCode()));
        }

        if ($this->getCODFundsCode()) {
            $node->appendChild($document->createElement('CODFundsCode', $this->getCODFundsCode()));
        }

        if ($this->getCODAmount()) {
            $node->appendChild($this->getCODAmount()->toNode($document));
        }

        return $node;
    }

    /**
     * @return mixed
     */
    public function getCODCode()
    {
        return $this->CODCode;
    }

    /**
     * @param mixed $CODCode
     * @return COD
     */
    public function setCODCode($CODCode)
    {
        $this->CODCode = $CODCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCODFundsCode()
    {
        return $this->CODFundsCode;
    }

    /**
     * @param mixed $CODFundsCode
     * @return COD
     */
    public function setCODFundsCode($CODFundsCode)
    {
        $this->CODFundsCode = $CODFundsCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCODAmount()
    {
        return $this->CODAmount;
    }

    /**
     * @param mixed $CODAmount
     * @return COD
     */
    public function setCODAmount($CODAmount)
    {
        $this->CODAmount = $CODAmount;
        return $this;
    }
}
