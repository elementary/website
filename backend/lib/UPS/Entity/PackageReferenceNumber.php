<?php

namespace Ups\Entity;

class PackageReferenceNumber
{
    public $Number;
    public $BarCodeIndicator;
    public $Code;
    public $Value;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->Number)) {
                $this->Number = $response->Number;
            }
            if (isset($response->BarCodeIndicator)) {
                $this->BarCodeIndicator = $response->BarCodeIndicator;
            }
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
            if (isset($response->Value)) {
                $this->Value = $response->Value;
            }
        }
    }
}
