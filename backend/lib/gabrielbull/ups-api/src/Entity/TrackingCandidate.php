<?php

namespace Ups\Entity;

class TrackingCandidate
{
    public $TrackingNumber;
    public $DestinationPostalCode;
    public $DestinationCountryCode;
    public $PickupDateRange;

    public function __construct($response = null)
    {
        if (isset($response->TrackingNumber)) {
            $this->TrackingNumber = $response->TrackingNumber;
        }
        if (isset($response->DestinationPostalCode)) {
            $this->DestinationPostalCode = $response->DestinationPostalCode;
        }
        if (isset($response->DestinationCountryCode)) {
            $this->DestinationCountryCode = $response->DestinationCountryCode;
        }
        if (isset($response->PickupDateRange)) {
            $this->PickupDateRange = new PickupDateRange($response->PickupDateRange);
        }
    }
}
