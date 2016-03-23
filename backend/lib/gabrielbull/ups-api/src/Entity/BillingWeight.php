<?php

namespace Ups\Entity;

class BillingWeight
{
    /**
     * @var UnitOfMeasurement
     */
    public $UnitOfMeasurement;

    public $Weight;

    public function __construct($response = null)
    {
        $this->UnitOfMeasurement = new UnitOfMeasurement();

        if (null != $response) {
            if (isset($response->UnitOfMeasurement)) {
                $this->UnitOfMeasurement = new UnitOfMeasurement($response->UnitOfMeasurement);
            }
            if (isset($response->Weight)) {
                $this->Weight = $response->Weight;
            }
        }
    }
}
