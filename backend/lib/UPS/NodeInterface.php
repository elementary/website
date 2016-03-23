<?php

namespace Ups;

use DOMDocument;
use DOMNode;

interface NodeInterface
{
    /**
     * @param null|DOMDocument $document
     *
     * @return DOMNode
     */
    public function toNode(DOMDocument $document = null);
}
