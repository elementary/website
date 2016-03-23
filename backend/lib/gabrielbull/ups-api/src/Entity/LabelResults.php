<?php

namespace Ups\Entity;

class LabelResults
{
    public $TrackingNumber;
    public $LabelImage;
    public $Receipt;

    public function __construct($response = null)
    {
        $this->LabelImage = new LabelImage();

        if (null != $response) {
            if (isset($response->TrackingNumber)) {
                $this->TrackingNumber = $response->TrackingNumber;
            }
            if (isset($response->LabelImage)) {
                $this->LabelImage = new LabelImage($response->LabelImage);
            }
        }
    }
}
