<?php

namespace Ups\Entity;

class FailureNotification
{
    public $FailedEmailAddress;
    public $FailureNotificationCode;

    public function __construct($response = null)
    {
        $this->FailureNotificationCode = new FailureNotificationCode();

        if (null != $response) {
            if (isset($response->FailedEmailAddress)) {
                $this->FailedEmailAddress = $response->FailedEmailAddress;
            }
            if (isset($response->FailureNotificationCode)) {
                $this->FailureNotificationCode = new FailureNotificationCode($response->FailureNotificationCode);
            }
        }
    }
}
