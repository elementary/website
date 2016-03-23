<?php

namespace Ups\Entity;

class Manifest
{
    public $Shipper;
    public $ShipTo;
    public $ReferenceNumber;
    public $Service;
    public $PickupDate;
    public $ScheduledDeliveryDate;
    public $ScheduledDeliveryTime;
    public $DocumentsOnly;
    public $Package;
    public $ShipmentServiceOptions;
    public $ManufactureCountry;
    public $HarmonizedCode;
    public $CustomsValue;
    public $SpecialInstructions;
    public $ShipmentChargeType;
    public $BillToAccount;
    public $ConsigneeBillIndicator;
    public $CollectBillIndicator;
    public $LocationAssured;
    public $ImportControl;
    public $LabelDeliveryMethod;
    public $CommercialInvoiceRemoval;
    public $PostalServiceTrackingID;
    public $ReturnsFlexibleAccess;
    public $UPScarbonneutral;
    public $Product;
    public $UPSReturnsExchange;
    public $LiftGateOnDelivery;
    public $LiftGateOnPickUp;
    public $PickupPreference;
    public $DeliveryPreference;
    public $HoldForPickupAtUPSAccessPoint;
    public $UAPAddress;

    public function __construct($response = null)
    {
        $this->Shipper = new Shipper();
        $this->ReferenceNumber = new ReferenceNumber();
        $this->Service = new Service();
        $this->ShipmentServiceOptions = new ShipmentServiceOptions();
        $this->CustomsValue = new CustomsValue();
        $this->BillToAccount = new BillToAccount();
        $this->UAPAddress = new Address();

        if (null != $response) {
            if (isset($response->Shipper)) {
                $this->Shipper = new Shipper($response->Shipper);
            }
            if (isset($response->ShipTo)) {
                $this->ShipTo = new ShipTo($response->ShipTo);
            }
            if (isset($response->ReferenceNumber)) {
                if (is_array($response->ReferenceNumber)) {
                    foreach ($response->ReferenceNumber as $ReferenceNumber) {
                        $this->ReferenceNumber[] = new ReferenceNumber($ReferenceNumber);
                    }
                } else {
                    $this->ReferenceNumber[] = new ReferenceNumber($response->ReferenceNumber);
                }
            }
            if (isset($response->Service)) {
                $this->Service = new Service($response->Service);
            }
            if (isset($response->PickupDate)) {
                $this->PickupDate = $response->PickupDate;
            }
            if (isset($response->ScheduledDeliveryDate)) {
                $this->ScheduledDeliveryDate = $response->ScheduledDeliveryDate;
            }
            if (isset($response->ScheduledDeliveryTime)) {
                $this->ScheduledDeliveryTime = $response->ScheduledDeliveryTime;
            }
            if (isset($response->DocumentsOnly)) {
                $this->DocumentsOnly = $response->DocumentsOnly;
            }
            if (isset($response->Package)) {
                if (is_array($response->Package)) {
                    foreach ($response->Package as $Package) {
                        $this->Package[] = new Package($Package);
                    }
                } else {
                    $this->Package[] = new Package($response->Package);
                }
            }
            if (isset($response->ShipmentServiceOptions)) {
                $this->ShipmentServiceOptions = new ShipmentServiceOptions($response->ShipmentServiceOptions);
            }
            if (isset($response->ManufactureCountry)) {
                $this->ManufactureCountry = $response->ManufactureCountry;
            }
            if (isset($response->HarmonizedCode)) {
                $this->HarmonizedCode = $response->HarmonizedCode;
            }
            if (isset($response->CustomsValue)) {
                $this->CustomsValue = new CustomsValue($response->CustomsValue);
            }
            if (isset($response->SpecialInstructions)) {
                $this->SpecialInstructions = $response->SpecialInstructions;
            }
            if (isset($response->ShipmentChargeType)) {
                $this->ShipmentChargeType = $response->ShipmentChargeType;
            }
            if (isset($response->BillToAccount)) {
                $this->BillToAccount = new BillToAccount($response->BillToAccount);
            }
            if (isset($response->ConsigneeBillIndicator)) {
                $this->ConsigneeBillIndicator = $response->ConsigneeBillIndicator;
            }
            if (isset($response->CollectBillIndicator)) {
                $this->CollectBillIndicator = $response->CollectBillIndicator;
            }
            if (isset($response->LocationAssured)) {
                $this->LocationAssured = $response->LocationAssured;
            }
            if (isset($response->ImportControl)) {
                $this->ImportControl = $response->ImportControl;
            }
            if (isset($response->LabelDeliveryMethod)) {
                $this->LabelDeliveryMethod = $response->LabelDeliveryMethod;
            }
            if (isset($response->CommercialInvoiceRemoval)) {
                $this->CommercialInvoiceRemoval = $response->CommercialInvoiceRemoval;
            }
            if (isset($response->PostalServiceTrackingID)) {
                $this->PostalServiceTrackingID = $response->PostalServiceTrackingID;
            }
            if (isset($response->ReturnsFlexibleAccess)) {
                $this->ReturnsFlexibleAccess = $response->ReturnsFlexibleAccess;
            }
            if (isset($response->UPScarbonneutral)) {
                $this->UPScarbonneutral = $response->UPScarbonneutral;
            }
            if (isset($response->Product)) {
                $this->Product = $response->Product;
            }
            if (isset($response->UPSReturnsExchange)) {
                $this->UPSReturnsExchange = $response->UPSReturnsExchange;
            }
            if (isset($response->LiftGateOnDelivery)) {
                $this->LiftGateOnDelivery = $response->LiftGateOnDelivery;
            }
            if (isset($response->LiftGateOnPickUp)) {
                $this->LiftGateOnPickUp = $response->LiftGateOnPickUp;
            }
            if (isset($response->PickupPreference)) {
                $this->PickupPreference = $response->PickupPreference;
            }
            if (isset($response->DeliveryPreference)) {
                $this->DeliveryPreference = $response->DeliveryPreference;
            }
            if (isset($response->HoldForPickupAtUPSAccessPoint)) {
                $this->HoldForPickupAtUPSAccessPoint = $response->HoldForPickupAtUPSAccessPoint;
            }
            if (isset($response->UAPAddress)) {
                $this->UAPAddress = new Address($response->UAPAddress);
            }
        }
    }
}
