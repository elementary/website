<?php

namespace Ups\Entity;

class SubscriptionFile
{
    public $FileName;
    public $StatusType;
    public $Manifest;
    public $Origin;
    public $Exception;
    public $Delivery;
    public $Generic;

    public function __construct($response = null)
    {
        $this->StatusType = new StatusType();
        $this->Manifest = new Manifest();
        $this->Origin = new Origin();
        $this->Exception = new Exception();
        $this->Delivery = new Delivery();
        $this->Generic = new Generic();

        if (null != $response) {
            if (isset($response->FileName)) {
                $this->FileName = $response->FileName;
            }
            if (isset($response->StatusType)) {
                $this->StatusType = new StatusType($response->StatusType);
            }
            if (isset($response->Manifest)) {
                $this->Manifest = new Manifest($response->Manifest);
            }
            if (isset($response->Origin)) {
                $this->Origin = new Origin($response->Origin);
            }
            if (isset($response->Exception)) {
                $this->Exception = new Exception($response->Exception);
            }
            if (isset($response->Delivery)) {
                $this->Delivery = new Delivery($response->Delivery);
            }
            if (isset($response->Generic)) {
                $this->Generic = new Generic($response->Generic);
            }
        }
    }
}
