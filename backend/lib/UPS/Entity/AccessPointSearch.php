<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class AccessPointSearch implements NodeInterface
{
    /**
     * Access Point Status Codes.
     */
    const STATUS_ACTIVE_AVAILABLE = '01';
    const STATUS_ACTIVE_UNAVAILABLE = '07';

    /**
     * @var
     */
    private $publicAccessPointId;

    /**
     * @var
     */
    private $accessPointStatus;

    /**
     * @var
     */
    private $accountNumber;

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

        $node = $document->createElement('AccessPointSearch');

        if ($this->getAccessPointStatus()) {
            $node->appendChild($document->createElement('AccessPointStatus', $this->getAccessPointStatus()));
        }

        if ($this->getPublicAccessPointId()) {
            $node->appendChild($document->createElement('PublicAccessPointID', $this->getPublicAccessPointId()));
        }

        if ($this->getAccountNumber()) {
            $node->appendChild($document->createElement('AccountNumber', $this->getAccountNumber()));
        }

        return $node;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param mixed $accountNumber
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     * @return mixed
     */
    public function getPublicAccessPointId()
    {
        return $this->publicAccessPointId;
    }

    /**
     * @param mixed $publicAccessPointId
     */
    public function setPublicAccessPointId($publicAccessPointId)
    {
        $this->publicAccessPointId = $publicAccessPointId;
    }

    /**
     * @return mixed
     */
    public function getAccessPointStatus()
    {
        return $this->accessPointStatus;
    }

    /**
     * @param mixed $accessPointStatus
     */
    public function setAccessPointStatus($accessPointStatus)
    {
        $this->accessPointStatus = $accessPointStatus;
    }
}
