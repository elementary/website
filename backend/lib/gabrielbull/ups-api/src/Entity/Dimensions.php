<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Dimensions implements NodeInterface
{
    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var UnitOfMeasurement
     */
    private $unitOfMeasurement;

    public function __construct($response = null)
    {
        $this->setUnitOfMeasurement(new UnitOfMeasurement(
            isset($response->UnitOfMeasurement) ? $response->UnitOfMeasurement : null)
        );

        if (null != $response) {
            if (isset($response->Length)) {
                $this->setLength($response->Length);
            }
            if (isset($response->Width)) {
                $this->setWidth($response->Width);
            }
            if (isset($response->Height)) {
                $this->setHeight($response->Height);
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

        $node = $document->createElement('Dimensions');
        $node->appendChild($document->createElement('Length', $this->getLength()));
        $node->appendChild($document->createElement('Height', $this->getHeight()));
        $node->appendChild($document->createElement('Width', $this->getWidth()));
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
        $this->unitOfMeasurement = $unitOfMeasurement;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $var
     * @return Dimensions
     */
    public function setLength($var)
    {
        $this->length = $var;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $var
     * @return Dimensions
     */
    public function setWidth($var)
    {
        $this->width = $var;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $var
     * @return Dimensions
     */
    public function setHeight($var)
    {
        $this->height = $var;

        return $this;
    }
}
