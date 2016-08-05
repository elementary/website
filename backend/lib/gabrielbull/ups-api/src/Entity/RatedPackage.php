<?php

namespace Ups\Entity;

class RatedPackage
{
    public $Weight;
    public $BillingWeight;
    public $TransportationCharges;
    public $ServiceOptionsCharges;
    public $TotalCharges;

    public function __construct($response = null)
    {
        $this->BillingWeight = new BillingWeight();
        $this->TransportationCharges = new Charges();
        $this->ServiceOptionsCharges = new Charges();
        $this->TotalCharges = new Charges();
        $this->Weight = '0.0';

        if (null != $response) {
            if (isset($response->Weight)) {
                $this->Weight = $response->Weight;
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
        }
    }
}
