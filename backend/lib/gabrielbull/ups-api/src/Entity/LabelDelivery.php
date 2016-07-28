<?php

namespace Ups\Entity;

class LabelDelivery
{
    public $LabelLinkIndicator;

    public function __construct($response = null)
    {
        $this->LabelLinkIndicator = null;

        if (null != $response) {
            if (isset($response->LabelLinkIndicator)) {
                $this->LabelLinkIndicator = true;
            }
        }
    }
}
