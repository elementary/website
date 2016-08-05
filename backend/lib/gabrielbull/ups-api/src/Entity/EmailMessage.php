<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class EmailMessage implements NodeInterface
{
    /**
     * @var array
     */
    private $emailAddresses = [];

    /**
     * @var string
     */
    private $undeliverableEmailAddress;

    /**
     * @var string
     */
    private $fromEmailAddress;

    /**
     * @var string
     */
    private $fromName;

    /**
     * @var string
     */
    private $memo;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $subjectCode;

    /**
     * Subject codes.
     */
    const SUBJECT_CODE_SHIPMENT_REFERENCE_NR1 = '01';
    const SUBJECT_CODE_SHIPMENT_REFERENCE_NR2 = '02';
    const SUBJECT_CODE_SHIPMENT_PACKAGE_NR1 = '03';
    const SUBJECT_CODE_SHIPMENT_PACKAGE_NR2 = '04';
    const SUBJECT_CODE_SUBJECT_TEXT = '08'; // Return only

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

        $node = $document->createElement('EMailMessage');

        foreach ($this->getEmailAddresses() as $email) {
            $node->appendChild($document->createElement('EMailAddress', $email));
        }

        if ($this->getUndeliverableEmailAddress() !== null) {
            $node->appendChild($document->createElement('UndeliverableEMailAddress', $this->getUndeliverableEmailAddress()));
        }

        if ($this->getFromEmailAddress() !== null) {
            $node->appendChild($document->createElement('FromEMailAddress', $this->getFromEmailAddress()));
        }

        if ($this->getFromName() !== null) {
            $node->appendChild($document->createElement('FromName', $this->getFromName()));
        }

        if ($this->getMemo() !== null) {
            $node->appendChild($document->createElement('Memo', $this->getMemo()));
        }

        if ($this->getSubject() !== null) {
            $node->appendChild($document->createElement('Subject', $this->getSubject()));
        }

        if ($this->getSubjectCode() !== null) {
            $node->appendChild($document->createElement('SubjectCode', $this->getSubjectCode()));
        }

        return $node;
    }

    /**
     * @return array
     */
    public function getEmailAddresses()
    {
        return $this->emailAddresses;
    }

    /**
     * @param array $emailAddresses
     *
     * @throws \Exception
     */
    public function setEmailAddresses(array $emailAddresses)
    {
        if (count($emailAddresses) > 5) {
            throw new \Exception('Maximum of 5 emailaddresses allowed');
        }

        $this->emailAddresses = $emailAddresses;
    }

    /**
     * @return mixed
     */
    public function getUndeliverableEmailAddress()
    {
        return $this->undeliverableEmailAddress;
    }

    /**
     * @param mixed $undeliverableEmailAddress
     */
    public function setUndeliverableEmailAddress($undeliverableEmailAddress)
    {
        $this->undeliverableEmailAddress = $undeliverableEmailAddress;
    }

    /**
     * @return mixed
     */
    public function getFromEmailAddress()
    {
        return $this->fromEmailAddress;
    }

    /**
     * @param mixed $fromEmailAddress
     */
    public function setFromEmailAddress($fromEmailAddress)
    {
        $this->fromEmailAddress = $fromEmailAddress;
    }

    /**
     * @return mixed
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param mixed $fromName
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
    }

    /**
     * @return mixed
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * @param mixed $memo
     *
     * @throws \Exception
     */
    public function setMemo($memo)
    {
        if (strlen($memo) > 50) {
            throw new \Exception('Memo should maximum be 50 chars');
        }

        $this->memo = $memo;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     *
     * @throws \Exception
     */
    public function setSubject($subject)
    {
        if (strlen($subject) > 50) {
            throw new \Exception('Subject should maximum be 50 chars');
        }

        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    /**
     * @param mixed $subjectCode
     */
    public function setSubjectCode($subjectCode)
    {
        $this->subjectCode = $subjectCode;
    }
}
