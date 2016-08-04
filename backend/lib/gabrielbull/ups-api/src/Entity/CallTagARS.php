<?php

namespace Ups\Entity;

class CallTagARS
{
    const CTA_NORETURN = '00';
    const CTA_CALLTAGSERVICE = '01';
    const CTA_PRINTANDMAIL = '02';
    const CTA_PICKUPATTEMPT = '03';
    const CTA_PRINTRETURNLABEL = '04';
    const CTA_ONLINECALLTAG = '05';
    const CTA_ELECTRONICRETURNLABEL = '06';
    const CTA_RETURNSONTHEWEB = '08';

    public $Number;
    public $Code;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->Number)) {
                $this->Number = $response->Number;
            }
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
        }
    }
}
