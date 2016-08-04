<?php

namespace Ups\Entity;

class NegotiatedRates
{
    /**
     * @var NetSummaryCharges
     */
    public $NetSummaryCharges;

    public function __construct($response = null)
    {
        $this->NetSummaryCharges = new NetSummaryCharges();

        if (null !== $response) {
            if (isset($response->NetSummaryCharges)) {
                $this->NetSummaryCharges = new NetSummaryCharges($response->NetSummaryCharges);
            }
        }
    }
}
