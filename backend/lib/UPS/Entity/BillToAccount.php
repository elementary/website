<?php

namespace Ups\Entity;

class BillToAccount
{
    const BTA_SHIPPER = '01';
    const BTA_CONSIGNEEBILLING = '02';
    const BTA_THIRDPARTY = '03';
    const BTA_FREIGHTCOLLECT = '04';

    public $Option;
    public $Number;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->Option)) {
                $this->Option = $response->Option;
            }
            if (isset($response->Number)) {
                $this->Number = $response->Number;
            }
        }
    }
}
