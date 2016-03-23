<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Service implements NodeInterface
{
    // Valid domestic values
    const S_AIR_1DAYEARLYAM = '14';
    const S_AIR_1DAY = '01';
    const S_AIR_1DAYSAVER = '13';
    const S_AIR_2DAYAM = '59';
    const S_AIR_2DAY = '02';
    const S_3DAYSELECT = '12';
    const S_GROUND = '03';

    // Valid international values
    const S_STANDARD = '11';
    const S_WW_EXPRESS = '07';
    const S_WW_EXPRESSPLUS = '54';
    const S_WW_EXPEDITED = '08';
    const S_SAVER = '65'; // Require for Rating, ignored for Shopping
    const S_ACCESS_POINT = '70'; // Access Point Economy

    // Valid Poland to Poland same day values
    const S_UPSTODAY_STANDARD = '82';
    const S_UPSTODAY_DEDICATEDCOURIER = '83';
    const S_UPSTODAY_INTERCITY = '84';
    const S_UPSTODAY_EXPRESS = '85';
    const S_UPSTODAY_EXPRESSSAVER = '86';
    const S_UPSWW_EXPRESSFREIGHT = '96';

    private static $serviceNames = [
        '01' => 'UPS Next Day Air',
        '02' => 'UPS Second Day Air',
        '03' => 'UPS Ground',
        '07' => 'UPS Worldwide Express',
        '08' => 'UPS Worldwide Expedited',
        '11' => 'UPS Standard',
        '12' => 'UPS Three-Day Select',
        '13' => 'Next Day Air Saver',
        '14' => 'UPS Next Day Air Early AM',
        '54' => 'UPS Worldwide Express Plus',
        '59' => 'UPS Second Day Air AM',
        '65' => 'UPS Saver',
        '70' => 'UPS Access Point Economy'
    ];

    /** @deprecated */
    public $Description;

    /**
     * @var string
     */
    private $code = self::S_GROUND;

    /**
     * @var string
     */
    private $description;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Code)) {
                $this->setCode($attributes->Code);
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
            }
        }
    }

    /**
     * @return array
     */
    public static function getServices()
    {
        return self::$serviceNames;
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

        $node = $document->createElement('Service');
        $node->appendChild($document->createElement('Code', $this->getCode()));
        $node->appendChild($document->createElement('Description', $this->getDescription()));

        return $node;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::$serviceNames[$this->getCode()];
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
        $this->Description = $description;
        $this->description = $description;

        return $this;
    }
}
