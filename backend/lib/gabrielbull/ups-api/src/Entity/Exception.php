<?php

namespace Ups\Entity;

class Exception
{
    public $PackageReferenceNumber;
    public $ShipmentReferenceNumber;
    public $TrackingNumber;
    public $Date;
    public $Time;
    public $UpdatedAddress;
    public $StatusCode;
    public $StatusDescription;
    public $ReasonCode;
    public $ReasonDescription;
    public $Resolution;
    public $RescheduledDeliveryDate;
    public $RescheduledDeliveryTime;
    public $ActivityLocation;
    public $BillToAccount;

    public function __construct($response = null)
    {
        $this->PackageReferenceNumber = [];
        $this->ShipmentReferenceNumber = [];
        $this->Resolution = new Resolution();
        $this->ActivityLocation = new ActivityLocation();
        $this->BillToAccount = new BillToAccount();

        if (null != $response) {
            if (isset($response->PackageReferenceNumber)) {
                foreach ($response->PackageReferenceNumber as $PackageReferenceNumber) {
                    $this->PackageReferenceNumber[] = new PackageReferenceNumber($PackageReferenceNumber);
                }
            }
            if (isset($response->ShipmentReferenceNumber)) {
                foreach ($response->ShipmentReferenceNumber as $ShipmentReferenceNumber) {
                    $this->ShipmentReferenceNumber[] = new ShipmentReferenceNumber($ShipmentReferenceNumber);
                }
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
            if (isset($response->UpdatedAddress)) {
                $this->UpdatedAddress = new UpdatedAddress($response->UpdatedAddress);
            }
            if (isset($response->StatusCode)) {
                $this->StatusCode = $response->StatusCode;
            }
            if (isset($response->StatusDescription)) {
                $this->StatusDescription = $response->StatusDescription;
            }
            if (isset($response->ReasonCode)) {
                $this->ReasonCode = $response->ReasonCode;
            }
            if (isset($response->ReasonDescription)) {
                $this->ReasonDescription = $response->ReasonDescription;
            }
            if (isset($response->Resolution)) {
                $this->Resolution = new Resolution($response->Resolution);
            }
            if (isset($response->RescheduledDeliveryDate)) {
                $this->RescheduledDeliveryDate = $response->RescheduledDeliveryDate;
            }
            if (isset($response->RescheduledDeliveryTime)) {
                $this->RescheduledDeliveryTime = $response->RescheduledDeliveryTime;
            }
            if (isset($response->ActivityLocation)) {
                $this->ActivityLocation = new ActivityLocation($response->ActivityLocation);
            }
            if (isset($response->BillToAccount)) {
                $this->BillToAccount = new BillToAccount($response->BillToAccount);
            }
        }
    }
}
