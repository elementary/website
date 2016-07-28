<?php

namespace Ups\Entity;

class SubscriptionEvents
{
    public $Name;
    public $Number;
    public $SubscriptionStatus;
    public $DateRange;

    public function __construct($response = null)
    {
        $this->SubscriptionStatus = new SubscriptionStatus();
        $this->DateRange = new DateRange();

        if (null != $response) {
            if (isset($response->Name)) {
                $this->Name = new $response->Name();
            }
            if (isset($response->Number)) {
                $this->Number = new $response->Number();
            }
            if (isset($response->SubscriptionStatus)) {
                $this->SubscriptionStatus = new SubscriptionStatus($response->SubscriptionStatus);
            }
            if (isset($response->DateRange)) {
                $this->DateRange = new DateRange($response->DateRange);
            }
        }
    }
}
