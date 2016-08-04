<?php

namespace Ups\Entity;

class LabelImage
{
    public $LabelImageFormat;
    public $GraphicImage;
    public $HTMLImage;
    public $PDF417;
    public $InternationalSignatureGraphicImage;
    public $URL;

    public function __construct($response = null)
    {
        $this->LabelImageFormat = new LabelImageFormat();

        if (null != $response) {
            if (isset($response->LabelImageFormat)) {
                $this->LabelImageFormat = new LabelImageFormat($response->LabelImageFormat);
            }
        }
    }
}
