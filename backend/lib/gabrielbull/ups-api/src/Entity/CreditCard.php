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
class CreditCard
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $expirationDate;

    /**
     * @var string
     */
    private $securityCode;

    /**
     * @var Address
     */
    private $address;

    public function __construct($attributes = null)
    {
        $this->setAddress(new Address(isset($attributes->Address) ? $attributes->Address : null));

        if (isset($attributes->Type)) {
            $this->setType($attributes->Type);
        }
        if (isset($attributes->Number)) {
            $this->setNumber($attributes->Number);
        }
        if (isset($attributes->ExpirationDate)) {
            $this->setExpirationDate($attributes->ExpirationDate);
        }
        if (isset($attributes->SecurityCode)) {
            $this->setSecurityCode($attributes->SecurityCode);
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return CreditCard
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return CreditCard
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    /**
     * @param string $securityCode
     * @return CreditCard
     */
    public function setSecurityCode($securityCode)
    {
        $this->securityCode = $securityCode;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return CreditCard
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param string $expirationDate
     * @return CreditCard
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }
}
