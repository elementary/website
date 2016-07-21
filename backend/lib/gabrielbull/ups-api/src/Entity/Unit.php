<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class Unit.
 */
class Unit implements NodeInterface
{
    /**
     * @var string
     */
    private $number = 1;

    /**
     * @var string
     */
    private $value;

    /**
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Number)) {
                $this->setNumber($attributes->Number);
            }
            if (isset($attributes->Value)) {
                $this->setValue($attributes->Value);
            }
            if (isset($attributes->UnitOfMeasurement)) {
                $this->setUnitOfMeasurement(new UnitOfMeasurement($attributes->UnitOfMeasurement));
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

        $node = $document->createElement('Unit');
        $node->appendChild($document->createElement('Number', $this->getNumber()));
        $node->appendChild($document->createElement('Value', $this->getValue()));
        if ($this->getUnitOfMeasurement() !== null) {
            $node->appendChild($this->getUnitOfMeasurement()->toNode($document));
        }

        return $node;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @param $value
     *
     * @throws \Exception
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = number_format($value, 6, '.', '');

        if (strlen((string)$this->value) > 19) {
            throw new \Exception('Value too long');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param UnitOfMeasurement $unit
     *
     * @return $this
     */
    public function setUnitOfMeasurement(UnitOfMeasurement $unit)
    {
        $this->unitOfMeasurement = $unit;

        return $this;
    }

    /**
     * @return UnitOfMeasurement
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }
}
