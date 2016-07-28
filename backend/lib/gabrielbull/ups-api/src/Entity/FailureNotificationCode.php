<?php

namespace Ups\Entity;

class FailureNotificationCode
{
    public $Code;
    public $Description;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->Code)) {
                $this->Code = $response->Code;
            }
            if (isset($response->Description)) {
                $this->Description = $response->Description;
            }
        }
    }
}
