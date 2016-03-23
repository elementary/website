<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ReferenceNumber implements NodeInterface
{
    /**
     * Codes.
     */
    const CODE_ACCOUNTS_RECEIVABLE_CUSTOMER_ACCOUNT = 'AJ';
    const CODE_APPROPRIATION_NUMBER = 'AT';
    const CODE_BILL_OF_LADING_NUMBER = 'BM';
    const CODE_COLLECT_ON_DEVELIVERY_COD_NUMBER = '9V';
    const CODE_DEALER_ORDER_NUMBER = 'ON';
    const CODE_DEPARTMENT_NUMBER = 'DP';
    const CODE_FOOD_AND_DRUG_ADMINISTRATION_PRODUCT_CODE = '3Q';
    const CODE_INVOICE_NUMBER = 'IK';
    const CODE_MANIFEST_KEY_NUMBER = 'MK';
    const CODE_MODEL_NUMBER = 'MJ';
    const CODE_PART_NUMBER = 'PM';
    const CODE_PRODUCTION_CODE = 'PC';
    const CODE_PURCHASE_ORDER_NUMBER = 'PO';
    const CODE_PURCHASE_REQUEST_NUMBER = 'RQ';
    const CODE_RETURN_AUTHORIZATION_NUMBER = 'RZ';
    const CODE_SALESPERSON_NUMBER = 'SA';
    const CODE_SERIAL_NUMBER = 'SE';
    const CODE_STORE_NUMBER = 'ST';
    const CODE_TRANSACTION_REFERENCE_NUMBER = 'TN';
    const CODE_EMPLOYER_ID_NUMBER = 'EI';
    const CODE_FEDERAL_TAXPAYER_ID = 'TJ';
    const CODE_SOCIAL_SECURITY_NUMBER = 'SY';

    /**
     * @var
     */
    private $code;

    /**
     * @var
     */
    private $value;

    /**
     * @var
     */
    private $barCodeIndicator;

    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function getBarCodeIndicator()
    {
        return $this->barCodeIndicator;
    }

    /**
     * @param bool $barCodeIndicator
     */
    public function setBarCodeIndicator($barCodeIndicator)
    {
        $this->barCodeIndicator = $barCodeIndicator;
    }

    /**
     * @param null $response
     */
    public function __construct($response = null)
    {
        if (null != $response) {
            if (isset($response->BarCodeIndicator)) {
                $this->setBarCodeIndicator($response->BarCodeIndicator);
            }
            if (isset($response->Code)) {
                $this->setCode($response->Code);
            }
            if (isset($response->Value)) {
                $this->setValue($response->Value);
            }
        }
    }

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

        $node = $document->createElement('ReferenceNumber');

        if ($this->getBarCodeIndicator()) {
            $node->appendChild($document->createElement('BarCodeIndicator'));
        }
        $node->appendChild($document->createElement('Code', $this->getCode()));
        $node->appendChild($document->createElement('Value', $this->getValue()));

        return $node;
    }
}
