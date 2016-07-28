<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;

class AddressKeyFormat extends Address
{
    /**
     * @var string
     */
    private $singleLineAddress;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->SingleLineAddress)) {
                $this->setSingleLineAddress($attributes->SingleLineAddress);
            }
        }

        parent::__construct($attributes);
    }

    /**
     * @return string
     */
    public function getSingleLineAddress()
    {
        return $this->singleLineAddress;
    }

    /**
     * @param string $singleLineAddress
     */
    public function setSingleLineAddress($singleLineAddress)
    {
        $this->singleLineAddress = $singleLineAddress;
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

        $node = $document->createElement('AddressKeyFormat');

        if ($this->getConsigneeName()) {
            $node->appendChild($document->createElement('ConsigneeName', $this->getConsigneeName()));
        }

        for ($i = 1; $i <= 3; $i++) {
            $line = $this->{'getAddressLine' . $i}();
            if ($line) {
                $node->appendChild($document->createElement('AddressLine' . ($i == 1 ? '' : $i), $line));
            }
        }

        for ($i = 1; $i <= 3; $i++) {
            $line = $this->{'getPoliticalDivision' . $i}();
            if ($line) {
                $node->appendChild($document->createElement('PoliticalDivision' . $i, $line));
            }
        }

        if ($this->getPostcodePrimaryLow()) {
            $node->appendChild($document->createElement('PostcodePrimaryLow', $this->getPostcodePrimaryLow()));
        }
        if ($this->getPostcodeExtendedLow()) {
            $node->appendChild($document->createElement('PostcodeExtendedLow', $this->getPostcodeExtendedLow()));
        }

        if ($this->getCountryCode()) {
            $node->appendChild($document->createElement('CountryCode', $this->getCountryCode()));
        }

        if ($this->getSingleLineAddress()) {
            $node->appendChild($document->createElement('SingleLineAddress', $this->getSingleLineAddress()));
        }

        return $node;
    }
}
