<?php

namespace Ups\Entity;

class Receipt
{
    public $HTMLImage;
    public $Image;

    public function __construct($response = null)
    {
        $this->Image = new Image();

        if (null != $response) {
            if (isset($response->HTMLImage)) {
                $this->HTMLImage = $response->HTMLImage;
            }
            if (isset($response->Image)) {
                $this->Image = new Image($response->Image);
            }
        }
    }
}
