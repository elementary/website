<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class PickupType implements NodeInterface
{
    const PKT_DAILY = '01';
    const PKT_CUSTOMERCOUNTER = '03';
    const PKT_ONETIME = '06';
    const PKT_AIR_ONCALL = '07';
    const PKT_LETTERCENTER = '19';
    const PKT_AIR_SERVICECENTER = '20';

    /** @deprecated */
    public $Code = self::PKT_DAILY;
    /** @deprecated */
    public $Description;

    /**
     * @var string
     */
    private $code = self::PKT_DAILY;

    /**
     * @var string
     */
    private $description;

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

        $node = $document->createElement('PickupType');
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
        $this->description = $description;

        return $this;
    }
}
