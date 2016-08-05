<?php

namespace Ups\Entity\Tradeability;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

/**
 * Class Product.
 */
class Product implements NodeInterface
{

    /**
     * @var string
     */
    private $productName;

    /**
     * @var string
     */
    private $productDescription;

    /**
     * @var string
     */
    private $productCountryCodeOfOrigin;

    /**
     * @var TariffInfo
     */
    private $tariffInfo;

    /**
     * @var Quantity
     */
    private $quantity;

    /**
     * @var UnitPrice
     */
    private $unitPrice;

    /**
     * @var Weight
     */
    private $weight;

    /**
     * @var int
     */
    private $tariffCodeAlert = 0;

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

        $node = $document->createElement('Product');

        // Required
        if ($this->getTariffInfo() !== null) {
            $node->appendChild($this->getTariffInfo()->toNode($document));
        }
        if ($this->getUnitPrice() !== null) {
            $node->appendChild($this->getUnitPrice()->toNode($document));
        }
        if ($this->getQuantity() !== null) {
            $node->appendChild($this->getQuantity()->toNode($document));
        }

        // Optional
        if ($this->getProductName() !== null) {
            $node->appendChild($document->createElement('ProductName', $this->getProductName()));
        }
        if ($this->getProductDescription() !== null) {
            $node->appendChild($document->createElement('ProductDescription', $this->getProductDescription()));
        }
        if ($this->getProductCountryCodeOfOrigin() !== null) {
            $node->appendChild(
                $document->createElement(
                    'ProductCountryCodeOfOrigin',
                    $this->getProductCountryCodeOfOrigin()
                )
            );
        }
        if ($this->getWeight() instanceof Weight) {
            $node->appendChild($this->getWeight()->toNode($document));
        }
        if ($this->getTariffCodeAlert() !== null) {
            $node->appendChild($document->createElement('TariffCodeAlert', $this->getTariffCodeAlert()));
        }

        return $node;
    }

    /**
     * @return TariffInfo
     */
    public function getTariffInfo()
    {
        return $this->tariffInfo;
    }

    /**
     * @param TariffInfo $tariffInfo
     * @return Product
     */
    public function setTariffInfo(TariffInfo $tariffInfo)
    {
        $this->tariffInfo = $tariffInfo;

        return $this;
    }

    /**
     * @return UnitPrice
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param UnitPrice $unitPrice
     * @return Product
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * @return Quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param Quantity $quantity
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     * @return Product
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * @param string $productDescription
     * @return Product
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductCountryCodeOfOrigin()
    {
        return $this->productCountryCodeOfOrigin;
    }

    /**
     * @param string $productCountryCodeOfOrigin
     * @return Product
     */
    public function setProductCountryCodeOfOrigin($productCountryCodeOfOrigin)
    {
        $this->productCountryCodeOfOrigin = $productCountryCodeOfOrigin;

        return $this;
    }

    /**
     * @return Weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param Weight $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int
     */
    public function getTariffCodeAlert()
    {
        return $this->tariffCodeAlert;
    }

    /**
     * @param int $tariffCodeAlert
     * @return Product
     */
    public function setTariffCodeAlert($tariffCodeAlert)
    {
        $this->tariffCodeAlert = $tariffCodeAlert;

        return $this;
    }
}
