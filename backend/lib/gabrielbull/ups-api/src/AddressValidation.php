<?php

namespace Ups;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use stdClass;
use Ups\Entity\Address;
use Ups\Entity\AddressValidationResponse;

/**
 * Address Validation API Wrapper.
 */
class AddressValidation extends Ups
{
    const ENDPOINT = '/XAV';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     *
     * @todo make private
     */
    public $response;

    /**
     * @var int
     */
    private $requestOption;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var int
     */
    private $maxSuggestion;
    /**
     * @var bool
     */
    private $useAVResponseObject = false;

    /**
     * Request Options.
     */
    const REQUEST_OPTION_ADDRESS_VALIDATION = 1;
    const REQUEST_OPTION_ADDRESS_CLASSIFICATION = 2;
    const REQUEST_OPTION_ADDRESS_VALIDATION_AND_CLASSIFICATION = 3;

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface|null $request
     * @param LoggerInterface|null $logger PSR3 compatible logger (optional)
     */
    public function __construct(
        $accessKey = null,
        $userId = null,
        $password = null,
        $useIntegration = false,
        RequestInterface $request = null,
        LoggerInterface $logger = null
    ) {
        if (null !== $request) {
            $this->setRequest($request);
        }
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * Turn on returning of the AddressValidationResponse object
     */
    public function activateReturnObjectOnValidate()
    {
        $this->useAVResponseObject = true;
    }

    /**
     * Turn off returning of the AddressValidationResponse object
     */
    public function deActivateReturnObjectOnValidate()
    {
        $this->useAVResponseObject = false;
    }
    /**
     * Get address suggestions from UPS.
     *
     * @param $address
     * @param int $requestOption
     * @param int $maxSuggestion
     *
     * @throws Exception
     *
     * @return stdClass|AddressValidationResponse
     */
    public function validate($address, $requestOption = self::REQUEST_OPTION_ADDRESS_VALIDATION, $maxSuggestion = 15)
    {
        if ($maxSuggestion > 50) {
            throw new \Exception('Maximum of 50 suggestions allowed');
        }

        if (!in_array($requestOption, range(1, 3))) {
            throw new \Exception('Invalid request option supplied');
        }

        $this->address = $address;
        $this->requestOption = $requestOption;
        $this->maxSuggestion = $maxSuggestion;

        $access = $this->createAccess();
        $request = $this->createRequest();

        $this->response = $this->getRequest()->request($access, $request, $this->compileEndpointUrl(self::ENDPOINT));
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        if ($response instanceof SimpleXMLElement && $response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        }
        if ($this->useAVResponseObject) {
            unset($response->Response);
            $avResponse = new AddressValidationResponse($response, $requestOption);
            return $avResponse;
        }
        return $this->formatResponse($response);
    }

    /**
     * Create the XAV request.
     *
     * @return string
     */
    private function createRequest()
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $avRequest = $xml->appendChild($xml->createElement('AddressValidationRequest'));
        $avRequest->setAttribute('xml:lang', 'en-US');

        $request = $avRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'XAV'));

        if (null !== $this->requestOption) {
            $request->appendChild($xml->createElement('RequestOption', $this->requestOption));
        }

        if (null !== $this->maxSuggestion) {
            $avRequest->appendChild($xml->createElement('MaximumListSize', $this->maxSuggestion));
        }

        if (null !== $this->address) {
            $addressNode = $avRequest->appendChild($xml->createElement('AddressKeyFormat'));

            if ($this->address->getAttentionName()) {
                $addressNode->appendChild($xml->createElement('ConsigneeName', $this->address->getAttentionName()));
            }
            if ($this->address->getBuildingName()) {
                $addressNode->appendChild($xml->createElement('BuildingName', $this->address->getBuildingName()));
            }
            if ($this->address->getAddressLine1()) {
                $addressNode->appendChild($xml->createElement('AddressLine', $this->address->getAddressLine1()));
            }
            if ($this->address->getAddressLine2()) {
                $addressNode->appendChild($xml->createElement('AddressLine', $this->address->getAddressLine2()));
            }
            if ($this->address->getAddressLine3()) {
                $addressNode->appendChild($xml->createElement('AddressLine', $this->address->getAddressLine3()));
            }
            if ($this->address->getStateProvinceCode()) {
                $addressNode->appendChild($xml->createElement('PoliticalDivision1',
                    $this->address->getStateProvinceCode()));
            }
            if ($this->address->getCity()) {
                $addressNode->appendChild($xml->createElement('PoliticalDivision2', $this->address->getCity()));
            }
            if ($this->address->getCountryCode()) {
                $addressNode->appendChild($xml->createElement('CountryCode', $this->address->getCountryCode()));
            }
            if ($this->address->getPostalCode()) {
                $addressNode->appendChild($xml->createElement('PostcodePrimaryLow', $this->address->getPostalCode()));
            }
        }

        return $xml->saveXML();
    }

    /**
     * Format the response.
     *
     * @param SimpleXMLElement $response
     *
     * @return stdClass
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        return $this->convertXmlObject($response->AddressKeyFormat);
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        if (null === $this->request) {
            $this->request = new Request();
        }

        return $this->request;
    }

    /**
     * @param RequestInterface $request
     *
     * @return $this
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return $this
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;

        return $this;
    }
}
