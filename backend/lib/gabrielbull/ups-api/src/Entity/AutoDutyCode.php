<?php

namespace Ups\Entity;

class AutoDutyCode
{
    const ADC_DUTIABLE = '01';
    const ADC_NONDUTIABLE = '02';
    const ADC_LOWVALUE = '03';
    const ADC_COURIERREMISSION = '04';
    const ADC_GIFT = '05';
    const ADC_MILITARY = '06';
    const ADC_EXCEPTION = '07';
    const ADC_LINERELEASE = '08';
    const ADC_SECTION321LOWVALUE = '09';

    public function __construct()
    {
    }
}
