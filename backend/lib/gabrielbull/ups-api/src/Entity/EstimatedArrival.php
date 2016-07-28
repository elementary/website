<?php

namespace Ups\Entity;

class EstimatedArrival
{
    const EA_MONDAY = 'MON';
    const EA_TUESDAY = 'TUE';
    const EA_WEDNESDAY = 'WEB';
    const EA_THUSDAY = 'THU';
    const EA_FRIDAY = 'FRI';
    const EA_SATURDAY = 'SAT';
    // Sunday is an invalid day :-)

    public $BusinessTransitDays;
    public $Time;
    public $PickupDate;
    public $PickupTime;
    public $HolidayCount;
    public $DelayCount;
    public $Date;
    public $DayOfWeek;
    public $TotalTransitDays;
    public $CustomerCenterCutoff;
    public $RestDays;

    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->BusinessTransitDays)) {
                $this->BusinessTransitDays = $response->BusinessTransitDays;
            }
            if (isset($response->Time)) {
                $this->Time = $response->Time;
            }
            if (isset($response->PickupDate)) {
                $this->PickupDate = $response->PickupDate;
            }
            if (isset($response->PickupTime)) {
                $this->PickupTime = $response->PickupTime;
            }
            if (isset($response->HolidayCount)) {
                $this->HolidayCount = $response->HolidayCount;
            }
            if (isset($response->DelayCount)) {
                $this->DelayCount = $response->DelayCount;
            }
            if (isset($response->Date)) {
                $this->Date = $response->Date;
            }
            if (isset($response->DayOfWeek)) {
                $this->DayOfWeek = $response->DayOfWeek;
            }
            if (isset($response->TotalTransitDays)) {
                $this->TotalTransitDays = $response->TotalTransitDays;
            }
            if (isset($response->CustomerCenterCutoff)) {
                $this->CustomerCenterCutoff = $response->CustomerCenterCutoff;
            }
            if (isset($response->RestDays)) {
                $this->RestDays = $response->RestDays;
            }
        }
    }
}
