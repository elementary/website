<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ReturnService implements NodeInterface
{
    const PRINT_AND_MAIL_PNM = 2;
    const RETURN_SERVICE_1_ATTEMPT_RS1 = 3;
    const RETURN_SERVICE_3_ATTEMPT_RS3 = 5;
    const ELECTRONIC_RETURN_LABEL_ERL = 8;
    const PRINT_RETURN_LABEL_PRL = 9;
    const EXCHANGE_PRINT_RETURN_LABEL = 10;
    const PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_1 = 11;
    const PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_2 = 12;
    const PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_3 = 13;
    const PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_4 = 14;
    const PACK_AND_COLLECT_SERVICE_1_ATTEMPT_BOX_5 = 15;
    const PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_1 = 16;
    const PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_2 = 17;
    const PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_3 = 18;
    const PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_4 = 19;
    const PACK_AND_COLLECT_SERVICE_3_ATTEMPT_BOX_5 = 20;

    private static $serviceNames = [
        2 => 'UPS Print and Mail (PNM)',
        3 => 'UPS Return Service 1-Attempt (RS1)',
        5 => 'UPS Return Service 3-Attempt (RS3)',
        8 => 'UPS Electronic Return Label (ERL)',
        9 => 'UPS Print Return Label (PRL)',
        10 => 'UPS Exchange Print Return Label',
        11 => 'UPS Pack & Collect Service 1-Attempt Box 1',
        12 => 'UPS Pack & Collect Service 1-Attempt Box 2',
        13 => 'UPS Pack & Collect Service 1-Attempt Box 3',
        14 => 'UPS Pack & Collect Service 1-Attempt Box 4',
        15 => 'UPS Pack & Collect Service 1-Attempt Box 5',
        16 => 'UPS Pack & Collect Service 3-Attempt Box 1',
        17 => 'UPS Pack & Collect Service 3-Attempt Box 2',
        18 => 'UPS Pack & Collect Service 3-Attempt Box 3',
        19 => 'UPS Pack & Collect Service 3-Attempt Box 4',
        20 => 'UPS Pack & Collect Service 3-Attempt Box 5',
    ];

    /**
     * @var int
     */
    private $code;

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        if (null !== $attributes) {
            if (isset($attributes->Code)) {
                $this->setCode($attributes->Code);
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

        $node = $document->createElement('ReturnService');
        $node->appendChild($document->createElement('Code', $this->getCode()));

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
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}
