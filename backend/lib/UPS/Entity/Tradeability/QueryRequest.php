<?php

namespace Ups\Entity\Tradeability;

use DomDocument;
use DomElement;
use Ups\NodeInterface;

class QueryRequest implements NodeInterface
{

    /**
     * @var Shipment
     */
    private $shipment;

    /**
     * @var bool
     */
    private $suppressQuestionIndicator = false;

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

        $node = $document->createElement('QueryRequest');

        $node->appendChild($this->getShipment()->toNode($document));
        $node->appendChild(
            $document->createElement(
                'SuppressQuestionIndicator',
                ($this->isSuppressQuestionIndicator() ? 'Y' : 'N')
            )
        );

        return $node;
    }

    /**
     * @return Shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * @param Shipment $shipment
     * @return QueryRequest
     */
    public function setShipment($shipment)
    {
        $this->shipment = $shipment;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSuppressQuestionIndicator()
    {
        return $this->suppressQuestionIndicator;
    }

    /**
     * @param boolean $suppressQuestionIndicator
     * @return QueryRequest
     */
    public function setSuppressQuestionIndicator($suppressQuestionIndicator)
    {
        $this->suppressQuestionIndicator = $suppressQuestionIndicator;

        return $this;
    }
}
