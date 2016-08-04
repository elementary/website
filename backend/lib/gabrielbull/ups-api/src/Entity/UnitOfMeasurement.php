<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class UnitOfMeasurement implements NodeInterface
{
    // PackageWeight
    const UOM_LBS = 'LBS'; // Pounds (defalut)
    const UOM_KGS = 'KGS'; // Kilograms

    // Dimensions
    const UOM_IN = 'IN'; // Inches
    const UOM_CM = 'CM'; // Centimeters

    // Dimensions for Locator
    const UOM_MI = 'MI'; // Miles
    const UOM_KM = 'KM'; // Kilometers

    // Products
    const PROD_BARREL = 'BA';
    const PROD_BUNDLE = 'BE';
    const PROD_BAG = 'BG';
    const PROD_BUNCH = 'BH';
    const PROD_BOX = 'BOX';
    const PROD_BOLT = 'BT';
    const PROD_BUTT = 'BU';
    const PROD_CANISTER = 'CI';
    const PROD_CENTIMETER = 'CM';
    const PROD_CONTAINER = 'CON';
    const PROD_CRATE = 'CR';
    const PROD_CASE = 'CS';
    const PROD_CARTON = 'CT';
    const PROD_CYLINDER = 'CY';
    const PROD_DOZEN = 'DOZ';
    const PROD_EACH = 'EA';
    const PROD_ENVELOPE = 'EN';
    const PROD_FEET = 'FT';
    const PROD_KILOGRAM = 'KG';
    const PROD_KILOGRAMS = 'KGS';
    const PROD_POUND = 'LB';
    const PROD_POUNDS = 'LBS';
    const PROD_LITER = 'L';
    const PROD_METER = 'M';
    const PROD_NUMBER = 'NMB';
    const PROD_PACKET = 'PA';
    const PROD_PALLET = 'PAL';
    const PROD_PIECE = 'PC';
    const PROD_PIECES = 'PCS';
    const PROD_PROOF_LITERS = 'PF';
    const PROD_PACKAGE = 'PKG';
    const PROD_PAIR = 'PR';
    const PROD_PAIRS = 'PRS';
    const PROD_ROLL = 'RL';
    const PROD_SET = 'SET';
    const PROD_SQUARE_METERS = 'SME';
    const PROD_SQUARE_YARDS = 'SYD';
    const PROD_TUBE = 'TU';
    const PROD_YARD = 'YD';
    const PROD_OTHER = 'OTH';

    /** @deprecated */
    public $Code = self::UOM_LBS;
    /** @deprecated */
    public $Description;

    /**
     * @var string
     */
    private $code = self::UOM_LBS;

    /**
     * @var string
     */
    private $description;

    /**
     * @param null|array $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Code)) {
                $this->setCode($attributes->Code);
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
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
        if (null !== $document) {
            $node = $document->createElement('UnitOfMeasurement');
            $node->appendChild($document->createElement('Code', $this->getCode()));
            $node->appendChild($document->createElement('Description', $this->getDescription()));

            return $node;
        }

        return new DOMElement('UnitOfMeasurement');
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
