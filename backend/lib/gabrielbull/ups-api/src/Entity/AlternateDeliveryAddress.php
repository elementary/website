<?php

namespace Ups\Entity;

use DOMDocument;

class AlternateDeliveryAddress extends ShipTo
{
    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $upsAccessPointId;

    /**
     * @param null|DOMDocument $document
     *
     * @return \DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('AlternateDeliveryAddress');

        if ($this->getName()) {
            $node->appendChild($document->createElement('Name', $this->getName()));
        }

        if ($this->getUpsAccessPointId()) {
            $node->appendChild($document->createElement('UPSAccessPointID', $this->getUpsAccessPointId()));
        }

        $address = $this->getAddress();
        if (isset($address)) {
            $node->appendChild($address->toNode($document));
        }

        return $node;
    }

    /**
     * @return mixed
     */
    public function getUpsAccessPointId()
    {
        return $this->upsAccessPointId;
    }

    /**
     * @param mixed $upsAccessPointId
     */
    public function setUpsAccessPointId($upsAccessPointId)
    {
        $this->upsAccessPointId = $upsAccessPointId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if (strlen($name) > 35) {
            $name = substr($name, 0, 35);
        }

        $this->name = $name;
    }
}
