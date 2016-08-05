<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

// @todo Extend with more notification options (e.g. VoiceMessage)
class Notification implements NodeInterface
{
    /**
     * @var
     */
    private $notificationCode;

    /**
     * @var
     */
    private $emailMessage;

    /**
     * @var
     */
    private $locale;

    /**
     * Notification Codes from documentation.
     */
    const CODE_RETURN_OR_LABEL_CREATION = '2'; // Only returns
    const CODE_QV_IN_TRANSIT = '5'; // Only forward shipments
    const CODE_QV_SHIP = '6'; // Only forward shipments
    const CODE_QV_EXCEPTION = '7';
    const CODE_QV_DELIVERY = '8';
    const CODE_ALTERNATE_DELIVERY_LOCATION = '012';
    const CODE_UAP_SHIPPER = '013';

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('Notification');

        $node->appendChild($document->createElement('NotificationCode', $this->getNotificationCode()));
        if ($this->getEmailMessage() !== null) {
            $node->appendChild($this->emailMessage->toNode($document));
        }
        if ($this->getLocale() !== null) {
            $node->appendChild($this->locale->toNode($document));
        }

        return $node;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     *
     * @return Notification
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNotificationCode()
    {
        return $this->notificationCode;
    }

    /**
     * @param mixed $notificationCode
     */
    public function setNotificationCode($notificationCode)
    {
        $this->notificationCode = $notificationCode;
    }

    /**
     * @return mixed
     */
    public function getEmailMessage()
    {
        return $this->emailMessage;
    }

    /**
     * @param mixed $emailMessage
     */
    public function setEmailMessage($emailMessage)
    {
        $this->emailMessage = $emailMessage;
    }
}
