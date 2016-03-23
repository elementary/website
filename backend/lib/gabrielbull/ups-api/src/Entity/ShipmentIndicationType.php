<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ShipmentIndicationType implements NodeInterface
{
    /**
     * @var
     */
    private $code;

    /**
     * @var
     */
    private $description;

    /**
     * Codes.
     */
    const CODE_HOLD_FOR_PICKUP_ACCESS_POINT = '01';
    const CODE_ACCESS_POINT_DELIVERY = '02';

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

        $node = $document->createElement('ShipmentIndicationType');

        $node->appendChild($document->createElement('Code', $this->getCode()));

        if ($this->getDescription()) {
            $node->appendChild($document->createElement('Description', $this->getDescription()));
        }

        return $node;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
