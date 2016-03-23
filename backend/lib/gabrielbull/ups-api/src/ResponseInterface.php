<?php

namespace Ups;

use SimpleXMLElement;

interface ResponseInterface
{
    /**
     * @return SimpleXMLElement
     */
    public function getResponse();

    /**
     * @param SimpleXMLElement $response
     */
    public function setResponse(SimpleXMLElement $response);

    /**
     * @return string
     */
    public function getText();

    /**
     * @param string $text
     */
    public function setText($text);
}
