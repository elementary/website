<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Exception as BaseException;
use Ups\NodeInterface;

class LocationSearchCriteria implements NodeInterface
{
    /**
     * @var AccessPointSearch
     */
    private $accessPointSearch;

    /**
     * @var
     */
    private $maximumListSize;

    /**
     * @return AccessPointSearch
     */
    public function getAccessPointSearch()
    {
        return $this->accessPointSearch;
    }

    /**
     * @param AccessPointSearch $accessPointSearch
     */
    public function setAccessPointSearch(AccessPointSearch $accessPointSearch)
    {
        $this->accessPointSearch = $accessPointSearch;
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

        $node = $document->createElement('LocationSearchCriteria');

        if ($this->getAccessPointSearch()) {
            $node->appendChild($this->getAccessPointSearch()->toNode($document));
        }

        if ($this->getMaximumListSize()) {
            $node->appendChild($document->createElement('MaximumListSize', $this->getMaximumListSize()));
        }

        return $node;
    }

    /**
     * @return mixed
     */
    public function getMaximumListSize()
    {
        return $this->maximumListSize;
    }

    /**
     * @param mixed $maximumListSize
     *
     * @throws BaseException
     */
    public function setMaximumListSize($maximumListSize)
    {
        $maximumListSize = (int)$maximumListSize;

        if ($maximumListSize < 1 || $maximumListSize > 50) {
            throw new BaseException('Maximum list size: If present, indicates the maximum number of locations the client wishes to receive in response; ranges from 1 to 50 with a default value of 10');
        }

        $this->maximumListSize = $maximumListSize;
    }
}
