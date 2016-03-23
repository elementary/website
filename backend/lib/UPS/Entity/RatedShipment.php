<?php

namespace Ups\Entity;

class RatedShipment
{
    public $Service;
    public $RateShipmentWarning;
    public $BillingWeight;
    public $TransportationCharges;
    public $ServiceOptionsCharges;
    public $TotalCharges;
    public $GuaranteedDaysToDelivery;
    public $ScheduledDeliveryTime;
    public $RatedPackage;
    public $SurCharges;
    /**
     * @var NegotiatedRates|null
     */
    public $NegotiatedRates;

    public function __construct($response = null)
    {
        $this->Service = new Service();
        $this->BillingWeight = new BillingWeight();
        $this->TransportationCharges = new Charges();
        $this->ServiceOptionsCharges = new Charges();
        $this->TotalCharges = new Charges();
        $this->RatedPackage = [];
        $this->SurCharges = [];

        if (null != $response) {
            if (isset($response->Service)) {
                $this->Service->setCode($response->Service->Code);
            }
            if (isset($response->RatedShipmentWarning)) {
                $this->RateShipmentWarning = $response->RatedShipmentWarning;
            }
            if (isset($response->BillingWeight)) {
                $this->BillingWeight = new BillingWeight($response->BillingWeight);
            }
            if (isset($response->TransportationCharges)) {
                $this->TransportationCharges = new Charges($response->TransportationCharges);
            }
            if (isset($response->ServiceOptionsCharges)) {
                $this->ServiceOptionsCharges = new Charges($response->ServiceOptionsCharges);
            }
            if (isset($response->TotalCharges)) {
                $this->TotalCharges = new Charges($response->TotalCharges);
            }
            if (isset($response->RatedPackage)) {
                if (is_array($response->RatedPackage)) {
                    foreach ($response->RatedPackage as $ratedPackage) {
                        $this->RatedPackage[] = new RatedPackage($ratedPackage);
                    }
                } else {
                    $this->RatedPackage[] = new RatedPackage($response->RatedPackage);
                }
            }

            if (isset($response->SurCharges)) {
                if (is_array($response->SurCharges)) {
                    foreach ($response->SurCharges as $surCharges) {
                        $this->SurCharges[] = new Charges($surCharges);
                    }
                } else {
                    $this->SurCharges[] = new Charges($response->SurCharges);
                }
            }

            if (isset($response->NegotiatedRates)) {
                $this->NegotiatedRates = new NegotiatedRates($response->NegotiatedRates);
            }
        }
    }

    public function getServiceName()
    {
        return $this->Service->getName();
    }
}
