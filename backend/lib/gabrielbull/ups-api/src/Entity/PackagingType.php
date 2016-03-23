<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class PackagingType implements NodeInterface
{
    const PT_UNKNOWN = '00';
    const PT_UPSLETTER = '01';
    const PT_PACKAGE = '02';
    const PT_TUBE = '03';
    const PT_PAK = '04';
    const PT_UPS_EXPRESSBOX = '21';
    const PT_UPS_25KGBOX = '24';
    const PT_UPS_10KGBOX = '25';
    const PT_PALLET = '30';
    const PT_EXPRESSBOX_S = '2a';
    const PT_EXPRESSBOX_M = '2b';
    const PT_EXPRESSBOX_L = '2c';
    const PT_FLATS = '56';
    const PT_PARCELS = '57';
    const PT_BPM = '58';
    const PT_FIRST_CLASS = '59';
    const PT_PRIORITY = '60';
    const PT_MACHINABLES = '61';
    const PT_IRREGULARS = '62';
    const PT_PARCEL_POST = '63';
    const PT_BPM_PARCEL = '64';
    const PT_MEDIA_MAIL = '65';
    const PT_BPM_FLAT = '66';
    const PT_STANDARD_FLAT = '67';

    /**
     * Required.
     * Valid Package types values are:
     * 01 = UPS Letter,
     * 02 = Customer Supplied Package,
     * 03 = Tube,
     * 04 = PAK,
     * 21 = UPS Express Box,
     * 24 = UPS 25KG Box,
     * 25 = UPS 10KG Box,
     * 30 = Pallet,
     * 2a = Small Express Box,
     * 2b = Medium Express Box,
     * 2c = Large Express Box,
     * 56 = Flats,
     * 57 = Parcels,
     * 58 = BPM,
     * 59 = First Class,
     * 60 = Priority,
     * 61 = Machinables,
     * 62 = Irregulars,
     * 63 = Parcel Post,
     *
     * 64 = BPM Parcel,
     * 65 = Media Mail,
     * 66 = BPM Flat,
     * 67 = Standard Flat
     *
     * @var string
     */
    private $code = self::PT_UNKNOWN;

    /**
     * @var string
     */
    private $description;

    public function __construct($attributes = null)
    {
        if (isset($attributes->Description)) {
            $this->setDescription($attributes->Description);
        }
        if (isset($attributes->Code)) {
            $this->setCode($attributes->Code);
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

        $node = $document->createElement('PackagingType');
        $node->appendChild($document->createElement('Code', $this->getCode()));
        $node->appendChild($document->createElement('Description', $this->getDescription()));

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
        $this->Code = $code;
        $this->code = $code;

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
        $this->Description = $description;
        $this->description = $description;

        return $this;
    }
}
