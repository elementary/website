<?php

namespace Ups\Entity;

class Delivery
{
    public $PackageReferenceNumber;
    public $ShipmentReferenceNumber;
    public $TrackingNumber;
    public $ShipperNumber;
    public $Date;
    public $Time;
    public $DriverRelease;
    public $ActivityLocation;
    public $DeliveryLocation;
    public $COD;
    public $BillToAccount;

    public function __construct($response = null)
    {
        $this->ShipmentReferenceNumber = new ShipmentReferenceNumber();
        $this->PackageReferenceNumber = new PackageReferenceNumber();
        $this->ActivityLocation = new ActivityLocation();
        $this->DeliveryLocation = new DeliveryLocation();
        $this->COD = new COD();
        $this->BillToAccount = new BillToAccount();

        if (null != $response) {
            if (isset($response->PackageReferenceNumber)) {
                if (is_array($response->PackageReferenceNumber)) {
                    foreach ($response->PackageReferenceNumber as $PackageReferenceNumber) {
                        $this->PackageReferenceNumber[] = new PackageReferenceNumber($PackageReferenceNumber);
                    }
                } else {
                    $this->PackageReferenceNumber[] = new PackageReferenceNumber($response->PackageReferenceNumber);
                }
            }
            if (isset($response->ShipmentReferenceNumber)) {
                if (is_array($response->ShipmentReferenceNumber)) {
                    foreach ($response->ShipmentReferenceNumber as $ShipmentReferenceNumber) {
                        $this->ShipmentReferenceNumber[] = new ShipmentReferenceNumber($ShipmentReferenceNumber);
                    }
                } else {
                    $this->ShipmentReferenceNumber[] = new ShipmentReferenceNumber($response->ShipmentReferenceNumber);
                }
            }
            if (isset($response->TrackingNumber)) {
                $this->TrackingNumber = $response->TrackingNumber;
            }
            if (isset($response->ShipperNumber)) {
                $this->ShipperNumber = $response->ShipperNumber;
            }
            if (isset($response->Date)) {
                $this->Date = $response->Date;
            }
            if (isset($response->Time)) {
                $this->Time = $response->Time;
            }
            if (isset($response->DriverRelease)) {
                $this->DriverRelease = $response->DriverRelease;
            }
            if (isset($response->ActivityLocation)) {
                $this->ActivityLocation = new ActivityLocation($response->ActivityLocation);
            }
            if (isset($response->DeliveryLocation)) {
                $this->DeliveryLocation = new DeliveryLocation($response->DeliveryLocation);
            }
            if (isset($response->COD)) {
                $this->COD = new COD($response->COD);
            }
            if (isset($response->BillToAccount)) {
                $this->BillToAccount = new BillToAccount($response->BillToAccount);
            }
        }
    }
}
