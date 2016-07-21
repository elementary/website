<?php

namespace Ups\Entity;

class StatusType
{
    const ST_IN_TRANSIT       = 'I';  // In Transit
    const ST_DELIVERED        = 'D';  // Delivered
    const ST_EXCEPTION        = 'X';  // Exception
    const ST_PICKUP           = 'P';  // Pickup
    const ST_MANIFEST_PICKUP  = 'M';  // Manifest Pickup

    public $Code;
    public $Description;

    private $statusTypeCodes = array(
        self::ST_IN_TRANSIT      => "In Transit",
        self::ST_DELIVERED       => "Delivered",
        self::ST_EXCEPTION       => "Exception",
        self::ST_PICKUP          => "Pickup",
        self::ST_MANIFEST_PICKUP => "Manifest Pickup"
    );

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
        }
        if (isset($response->Description)) {
            $this->Description = $response->Description;
        }
    }

    /**
     * @return string
     */
    public function getCodeName()
    {
        return $this->statusTypeCodes[$this->Code];
    }
}
