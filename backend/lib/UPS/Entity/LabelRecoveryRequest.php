<?php

namespace Ups\Entity;

class LabelRecoveryRequest
{
    public $LabelSpecification;
    public $Translate;
    public $LabelDelivery;
    public $TrackingNumber;
    public $ReferenceNumber;
    public $ShipperNumber;

    public function __construct($request = null)
    {
        $this->LabelSpecification = new LabelSpecification();
        $this->Translate = new Translate();
        $this->LabelDelivery = new LabelDelivery();
        $this->ReferenceNumber = new ReferenceNumber();
    }
}
