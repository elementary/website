<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class CustomerClassification implements NodeInterface
{
    const RT_SHIPPER  = '00';
    const RT_DAILY    = '01';
    const RT_RETAIL   = '04';
    const RT_REGIONAL = '05';
    const RT_GENLIST  = '06';
    const RT_STDLIST  = '53';

    /**
     * @var string
     */
    private $code;

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

        $node = $document->createElement('CustomerClassification');
        $node->appendChild($document->createElement('Code', $this->getCode()));

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
}
