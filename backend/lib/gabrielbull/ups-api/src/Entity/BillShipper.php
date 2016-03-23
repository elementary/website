<?php
/*
 * Copyright © Eduard Sukharev
 *
 * For a full license, see the LICENSE file.
 */

namespace Ups\Entity;

/**
 * @author Eduard Sukharev <eduard.sukharev@opensoftdev.ru>
 */
class BillShipper
{
    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var CreditCard
     */
    private $creditCard;

    public function __construct($attributes = null)
    {
        if (isset($attributes->AccountNumber)) {
            $this->setAccountNumber($attributes->AccountNumber);
        }
        if (isset($attributes->CreditCard)) {
            $this->setAccountNumber(new CreditCard($attributes->CreditCard));
        }
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     *
     * @return BillShipper
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * @return CreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCard $creditCard
     * @return BillShipper
     */
    public function setCreditCard(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;

        return $this;
    }
}
