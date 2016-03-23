<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Shipper implements NodeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $companyName;

    /**
     * @var string
     */
    protected $attentionName;

    /**
     * @var string
     */
    protected $taxIdentificationNumber;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $faxNumber;

    /**
     * @var string
     */
    protected $shipperNumber;

    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var Address
     */
    protected $address;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        $this->address = new Address();

        if (null !== $attributes) {
            if (isset($attributes->Name)) {
                $this->setName($attributes->Name);
            }
            if (isset($attributes->CompanyName)) {
                $this->setCompanyName($attributes->CompanyName);
            }
            if (isset($attributes->AttentionName)) {
                $this->setAttentionName($attributes->AttentionName);
            }
            if (isset($attributes->TaxIdentificationNumber)) {
                $this->setTaxIdentificationNumber($attributes->TaxIdentificationNumber);
            }
            if (isset($attributes->PhoneNumber)) {
                $this->setPhoneNumber($attributes->PhoneNumber);
            }
            if (isset($attributes->FaxNumber)) {
                $this->setFaxNumber($attributes->FaxNumber);
            }
            if (isset($attributes->ShipperNumber)) {
                $this->setShipperNumber($attributes->ShipperNumber);
            }
            if (isset($attributes->EMailAddress)) {
                $this->setEmailAddress($attributes->EMailAddress);
            }
            if (isset($attributes->Address)) {
                $this->setAddress(new Address($attributes->Address));
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

        $node = $document->createElement('Shipper');

        $shipperName = $this->getName();
        if (isset($shipperName)) {
            $node->appendChild($document->createElement('Name', $shipperName));
        }

        $shipperNumber = $this->getShipperNumber();
        if (isset($shipperNumber)) {
            $node->appendChild($document->createElement('ShipperNumber', $shipperNumber));
        }

        $address = $this->getAddress();
        if (isset($address)) {
            $node->appendChild($address->toNode($document));
        }

        return $node;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     *
     * @return Shipper
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getAttentionName()
    {
        return $this->attentionName;
    }

    /**
     * @param string $attentionName
     *
     * @return Shipper
     */
    public function setAttentionName($attentionName)
    {
        $this->attentionName = $attentionName;

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
     * @return Shipper
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    /**
     * @param string $faxNumber
     *
     * @return Shipper
     */
    public function setFaxNumber($faxNumber)
    {
        $this->faxNumber = $faxNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Shipper
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return Shipper
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getShipperNumber()
    {
        return $this->shipperNumber;
    }

    /**
     * @param string $shipperNumber
     *
     * @return Shipper
     */
    public function setShipperNumber($shipperNumber)
    {
        $this->shipperNumber = $shipperNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getTaxIdentificationNumber()
    {
        return $this->taxIdentificationNumber;
    }

    /**
     * @param string $taxIdentificationNumber
     *
     * @return Shipper
     */
    public function setTaxIdentificationNumber($taxIdentificationNumber)
    {
        $this->taxIdentificationNumber = $taxIdentificationNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @return Shipper
     */
    public function setCompanyName($companyName = null)
    {
        $this->companyName = $companyName;

        return $this;
    }
}
