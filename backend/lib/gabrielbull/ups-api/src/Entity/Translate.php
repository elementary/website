<?php

namespace Ups\Entity;

use DOMDocument;
use Ups\NodeInterface;

/**
 * Class Translate
 * @package Ups\Entity
 */
class Translate implements NodeInterface
{
    /**
     * @deprecated
     */
    public $LanguageCode;

    /**
     * @deprecated
     */
    public $DialectCode;

    /**
     * @deprecated
     */
    public $Code;

    /**
     * @var string
     */
    private $languageCode;

    /**
     * @var string
     */
    private $dialectCode;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $locale;

    /**
     * @param null $response
     */
    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->LanguageCode)) {
                $this->setLanguageCode($response->LanguageCode);
            }
            if (isset($response->DialectCode)) {
                $this->setDialectCode($response->DialectCode);
            }
            if (isset($response->Code)) {
                $this->setCode($response->Code);
            }
            if (isset($response->Locale)) {
                $this->setLocale($response->Locale);
            }
        }
    }

    /**
     * @param DOMDocument|null $document
     * @return \DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Translate');

        $node->appendChild($document->createElement('LanguageCode', $this->getLanguageCode()));

        if ($this->getCode()) {
            $node->appendChild($document->createElement('Code', $this->getCode()));
        }

        if ($this->getDialectCode()) {
            $node->appendChild($document->createElement('DialectCode', $this->getDialectCode()));
        }

        if ($this->getLocale()) {
            $node->appendChild($document->createElement('Locale', $this->getLocale()));
        }

        return $node;
    }

    /**
     * @return string|null
     */
    public function getLanguageCode()
    {
        return $this->languageCode;
    }

    /**
     * @param mixed $languageCode
     */
    public function setLanguageCode($languageCode)
    {
        $this->LanguageCode = $languageCode;
        $this->languageCode = $languageCode;
    }

    /**
     * @return string|null
     */
    public function getDialectCode()
    {
        return $this->dialectCode;
    }

    /**
     * @param mixed $dialectCode
     */
    public function setDialectCode($dialectCode)
    {
        $this->DialectCode = $dialectCode;
        $this->dialectCode = $dialectCode;
    }

    /**
     * @return null|string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->Code = $code;
        $this->code = $code;
    }

    /**
     * @return null|string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}
