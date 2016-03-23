<?php namespace Ups\Entity;

use Ups\AddressValidation;
use Ups\Entity\AddressValidation\AVAddress;
use Ups\Entity\AddressValidation\AddressClassification;

class AddressValidationResponse
{
    protected $response;
    protected $requestAction;

    /**
     * AddressValidationResponse constructor.
     * @param \SimpleXMLElement $xmlDocument
     * @param $requestAction
     */
    public function __construct(\SimpleXMLElement $xmlDocument, $requestAction)
    {
        $this->response = $xmlDocument;
        $this->requestAction = $requestAction;
    }

    /**
     * Tells whether or not the NoCandidatesIndicator is present on the XML document.
     * This indicator is returned if the address is so badly formed that UPS is
     * unable to even offer any suggested alternatives
     *
     * @throws \BadMethodCallException
     * @return bool
     */
    public function noCandidates()
    {
        if (AddressValidation::REQUEST_OPTION_ADDRESS_CLASSIFICATION == $this->requestAction) {
            throw new \BadMethodCallException(__METHOD__ . ' should not be called on Address Classification only requests.');
        }
        return isset($this->response->NoCandidatesIndicator);
    }

    /**
     * Tells whether or not the ValidAddressIndicator is present on the XML document.
     * This indicator is present if provided address is valid and represents a
     * single, unique address in the UPS Address Validation system.
     *
     * @return bool
     */
    public function isValid()
    {
        if (AddressValidation::REQUEST_OPTION_ADDRESS_CLASSIFICATION == $this->requestAction) {
            return $this->response->AddressClassification->Code > 0;
        }
        return isset($this->response->ValidAddressIndicator);
    }

    /**
     * Tells whether or not the AmbiguousAddressIndicator is present on the XML document.
     * This indicator is present when the address provided is not specific enough to
     * be unique to one physical location, but provides enough
     *
     * @throws \BadMethodCallException
     * @return bool
     */
    public function isAmbiguous()
    {
        if (AddressValidation::REQUEST_OPTION_ADDRESS_CLASSIFICATION == $this->requestAction) {
            throw new \BadMethodCallException(__METHOD__ . ' should not be called on Address Classification only requests.');
        }
        return isset($this->response->AmbiguousAddressIndicator);
    }

    /**
     * @throws \BadMethodCallException
     * @return AddressClassification
     */
    public function getAddressClassification()
    {
        if ($this->requestAction < AddressValidation::REQUEST_OPTION_ADDRESS_CLASSIFICATION) {
            throw new \BadMethodCallException('Address Classification was not requested.');
        }
        return new AddressClassification($this->response->AddressClassification);
    }

    /**
     * @return array
     */
    public function getCandidateAddressList()
    {
        if (!isset($this->response->AddressKeyFormat)) {
            return [];
        }
        $candidates = [];
        foreach ($this->response->AddressKeyFormat as $address) {
            $candidates[] = new AVAddress($address);
        }
        return $candidates;
    }

    /**
     * @return AVAddress
     */
    public function getValidatedAddress()
    {
        if ($this->requestAction == AddressValidation::REQUEST_OPTION_ADDRESS_CLASSIFICATION) {
            throw new \BadMethodCallException('Only Address Classification was requested. There is no address.');
        }

        return new AVAddress($this->response->AddressKeyFormat);
    }
}
