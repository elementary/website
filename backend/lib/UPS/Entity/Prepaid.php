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
class Prepaid
{
    /**
     * @var BillShipper
     */
    private $billShipper;

    public function __construct($attributes = null)
    {
        $this->setBillShipper(new BillShipper($attributes));
    }

    /**
     * @return BillShipper
     */
    public function getBillShipper()
    {
        return $this->billShipper;
    }

    /**
     * @param BillShipper $billShipper
     */
    public function setBillShipper($billShipper)
    {
        $this->billShipper = $billShipper;
    }
}
