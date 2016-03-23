<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class PackageWeight implements NodeInterface
{
    /** @deprecated */
    public $UnitOfMeasurement;

    /** @deprecated */
    public $Weight;

    /**
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    /**
     * @var string
     */
    private $weight;

    public function __construct($attributes = null)
    {
        $this->setUnitOfMeasurement(new UnitOfMeasurement(
            isset($attributes->UnitOfMeasurement) ? $attributes->UnitOfMeasurement : null
        ));
        if (isset($attributes->Weight)) {
            $this->setWeight($attributes->Weight);
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

        $node = $document->createElement('PackageWeight');
        $node->appendChild($document->createElement('Weight', $this->getWeight()));
        $node->appendChild($this->getUnitOfMeasurement()->toNode($document));

        return $node;
    }

    /**
     * @return UnitOfMeasurement
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }

    /**
     * @param UnitOfMeasurement $unitOfMeasurement
     *
     * @return $this
     */
    public function setUnitOfMeasurement(UnitOfMeasurement $unitOfMeasurement)
    {
        $this->UnitOfMeasurement = $unitOfMeasurement;
        $this->unitOfMeasurement = $unitOfMeasurement;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->Weight = $weight;
        $this->weight = $weight;

        return $this;
    }
}
