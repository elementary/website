<?php

namespace Ups\Entity;

class ServiceSummary
{
    public $Service;
    public $Guaranteed;
    public $EstimatedArrival;
    public $SaturdayDelivery;
    public $SaturdayDeliveryDisclaimer;

    public function __construct($response = null)
    {
        $this->Service = new Service();
        $this->Guaranteed = new Guaranteed();
        $this->EstimatedArrival = new EstimatedArrival();

        if (null != $response) {
            if (isset($response->Service)) {
                $this->Service = new Service($response->Service);
            }
            if (isset($response->Guaranteed)) {
                $this->Guaranteed = new Guaranteed($response->Guaranteed);
            }
            if (isset($response->EstimatedArrival)) {
                $this->EstimatedArrival = new EstimatedArrival($response->EstimatedArrival);
            }
        }
    }
}
