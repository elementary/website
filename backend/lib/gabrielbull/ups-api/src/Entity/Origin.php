<?php

namespace Ups\Entity;

class Origin
{
    public $PackageReferenceNumber;
    public $ShipmentReferenceNumber;
    public $ShipperNumber;
    public $TrackingNumber;
    public $Date;
    public $Time;
    public $ActivityLocation;
    public $BillToAccount;
    public $ScheduledDeliveryDate;
    public $ScheduledDeliveryTime;

    public function __construct($response = null)
    {
        $this->PackageReferenceNumber = new PackageReferenceNumber();
        $this->ShipmentReferenceNumber = new ShipmentReferenceNumber();
        $this->ActivityLocation = new ActivityLocation();
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
            if (isset($response->ShipperNumber)) {
                $this->ShipperNumber = $response->ShipperNumber;
            }
            if (isset($response->TrackingNumber)) {
                $this->TrackingNumber = $response->TrackingNumber;
            }
            if (isset($response->Date)) {
                $this->Date = $response->Date;
            }
            if (isset($response->Time)) {
                $this->Time = $response->Time;
            }
            if (isset($response->ActivityLocation)) {
                $this->ActivityLocation = new ActivityLocation($response->ActivityLocation);
            }
            if (isset($response->BillToAccount)) {
                $this->BillToAccount = new BillToAccount($response->BillToAccount);
            }
            if (isset($response->ScheduledDeliveryDate)) {
                $this->ScheduledDeliveryDate = $response->ScheduledDeliveryDate;
            }
            if (isset($response->ScheduledDeliveryTime)) {
                $this->ScheduledDeliveryTime = $response->ScheduledDeliveryTime;
            }
        }
    }
}
