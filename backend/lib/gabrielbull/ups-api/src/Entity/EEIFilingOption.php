<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class EEIFilingOption implements NodeInterface
{
    const FO_SHIPPER = '1';  // Shipper Filed
    const FO_UPS     = '3';  // UPS Filed

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $description;

    /**
     * @var UPSFiled
     */
    private $upsFiled;

    /**
     * @var ShipperFiled
     */
    private $shipperFiled;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Code)) {
                $this->setCode($attributes->Code);
            }
            if (isset($attributes->EmailAddress)) {
                $this->setEmailAddress($attributes->EmailAddress);
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
            }
            if (isset($attributes->UPSFiled)) {
                $this->setUPSFiled(new UPSFiled($attributes->UPSFiled));
            }
            if (isset($attributes->ShipperFiled)) {
                $this->setShipperFiled(new ShipperFiled($attributes->ShipperFiled));
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

        $node = $document->createElement('EEIFilingOption');

        $code = $this->getCode();
        if (isset($code)) {
            $node->appendChild($document->createElement('Code', $code));
        }

        $emailAddress = $this->getEmailAddress();
        if (isset($emailAddress)) {
            $node->appendChild($document->createElement('EMailAdress', $emailAddress));
        }

        $description = $this->getDescription();
        if (isset($description)) {
            $node->appendChild($document->createElement('Description', $description));
        }

        $upsFiled = $this->getUPSFiled();
        if (isset($upsFiled)) {
            $node->appendChild($upsFiled->toNode($document));
        }

        $shipperFiled = $this->getShipperFiled();
        if (isset($shipperFiled)) {
            $node->appendChild($shipperFiled->toNode($document));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     *
     * @return $this
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return UPSFiled
     */
    public function getUPSFiled()
    {
        return $this->upsFiled;
    }

    /**
     * @param UPSFiled $upsFiled
     *
     * @return $this
     */
    public function setUPSFiled(UPSFiled $upsFiled)
    {
        $this->upsFiled = $upsFiled;

        return $this;
    }

    /**
     * @return ShipperFiled
     */
    public function getShipperFiled()
    {
        return $this->shipperFiled;
    }

    /**
     * @param ShipperFiled $shipperFiled
     *
     * @return $this
     */
    public function setShipperFiled(ShipperFiled $shipperFiled)
    {
        $this->shipperFiled = $shipperFiled;

        return $this;
    }
}
