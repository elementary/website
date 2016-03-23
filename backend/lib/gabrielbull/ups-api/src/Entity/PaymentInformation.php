<?php

namespace Ups\Entity;

use LogicException;

class PaymentInformation
{
    const TYPE_PREPAID = 'prepaid';
    const TYPE_BILL_THIRD_PARTY = 'billThirdParty';
    const TYPE_FREIGHT_COLLECT = 'freightCollect';
    const TYPE_CONSIGNEE_BILLED = 'consigneeBilled';

    /**
     * @var Prepaid
     */
    private $prepaid;

    /**
     * @var BillThirdParty
     */
    private $billThirdParty;

    /**
     * @var FreightCollect
     */
    private $freightCollect;

    /**
     * @var bool
     */
    private $consigneeBilled;

    public function __construct($type = self::TYPE_PREPAID, $attributes = null)
    {
        switch ($type) {
            case self::TYPE_PREPAID:
                $this->prepaid = new Prepaid($attributes);
                break;
            case self::TYPE_BILL_THIRD_PARTY:
                $this->billThirdParty = new BillThirdParty($attributes);
                break;
            case self::TYPE_FREIGHT_COLLECT:
                $this->freightCollect = new FreightCollect($attributes);
                break;
            case self::TYPE_CONSIGNEE_BILLED:
                $this->consigneeBilled = true;
                break;
            default:
                throw new LogicException(sprintf('Unknown PaymentInformation type requested: "%s"', $type));
        }
    }

    /**
     * @return Prepaid
     */
    public function getPrepaid()
    {
        return $this->prepaid;
    }

    /**
     * @param Prepaid $prepaid
     * @return PaymentInformation
     */
    public function setPrepaid(Prepaid $prepaid = null)
    {
        $this->prepaid = $prepaid;

        return $this;
    }

    /**
     * @return BillThirdParty
     */
    public function getBillThirdParty()
    {
        return $this->billThirdParty;
    }

    /**
     * @param BillThirdParty $billThirdParty
     * @return PaymentInformation
     */
    public function setBillThirdParty(BillThirdParty $billThirdParty = null)
    {
        $this->billThirdParty = $billThirdParty;

        return $this;
    }

    /**
     * @return FreightCollect
     */
    public function getFreightCollect()
    {
        return $this->freightCollect;
    }

    /**
     * @param FreightCollect $freightCollect
     * @return PaymentInformation
     */
    public function setFreightCollect(FreightCollect $freightCollect = null)
    {
        $this->freightCollect = $freightCollect;

        return $this;
    }

    /**
     * @return bool
     */
    public function getConsigneeBilled()
    {
        return $this->consigneeBilled;
    }

    /**
     * @param bool $consigneeBilled
     * @return PaymentInformation
     */
    public function setConsigneeBilled($consigneeBilled)
    {
        $this->consigneeBilled = $consigneeBilled;

        return $this;
    }
}
