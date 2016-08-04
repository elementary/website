<?php

namespace Ups;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Ups\Entity\LocatorRequest;

/**
 * Locator API Wrapper.
 *
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class Locator extends Ups
{
    private $request;

    const ENDPOINT = '/Locator';

    const OPTION_DROP_LOCATIONS_AND_WILL_CALL_LOCATIONS = 1;
    const OPTION_ALL_AVAILABLE_ADDITIONAL_SERVICES = 8;
    const OPTION_ALL_AVAILABLE_PROGRAM_TYPES = 16;
    const OPTION_ALL_AVAILABLE_ADDITIONAL_SERVICES_AND_PROGRAM_TYPES = 24;
    const OPTION_ALL_AVAILABLE_RETAIL_LOCATIONS = 32;
    const OPTION_ALL_AVAILABLE_RETAIL_LOCATIONS_AND_ADDITIONAL_SERVICES = 40;
    const OPTION_ALL_AVAILABLE_RETAIL_LOCATIONS_AND_PROGRAM_TYPES = 48;
    const OPTION_ALL_AVAILABLE_RETAIL_LOCATIONS_AND_ADDITIONAL_SERVICES_AND_PROGRAM_TYPES = 56;
    const OPTION_UPS_ACCESS_POINT_LOCATIONS = 64;

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface $request
     * @param LoggerInterface $logger PSR3 compatible logger (optional)
     */
    public function __construct($accessKey = null, $userId = null, $password = null, $useIntegration = false, RequestInterface $request = null, LoggerInterface $logger = null)
    {
        if (null !== $request) {
            $this->setRequest($request);
        }
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    public function getLocations(LocatorRequest $request, $requestOption = self::OPTION_UPS_ACCESS_POINT_LOCATIONS)
    {
        return $this->sendRequest($request, $requestOption);
    }

    /**
     * Creates and sends a request for the given shipment. This handles checking for
     * errors in the response back from UPS.
     *
     * @param LocatorRequest $request
     * @param int $requestOption
     *
     * @throws Exception
     *
     * @return \stdClass
     */
    private function sendRequest(LocatorRequest $request, $requestOption)
    {
        $request = $this->createRequest($request, $requestOption);
        $this->response = $this->getRequest()->request($this->createAccess(), $request, $this->compileEndpointUrl(self::ENDPOINT));
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        if ($response instanceof SimpleXMLElement && $response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Create the TimeInTransit request.
     *
     * @param LocatorRequest $locatorRequest The request details. Refer to the UPS documentation for available structure
     * @param $requestOption
     *
     * @return string
     */
    private function createRequest(LocatorRequest $locatorRequest, $requestOption)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $trackRequest = $xml->appendChild($xml->createElement('LocatorRequest'));
        $trackRequest->setAttribute('xml:lang', 'en-US');

        $request = $trackRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'Locator'));
        $request->appendChild($xml->createElement('RequestOption', $requestOption));

        // Origin Address
        $trackRequest->appendChild($locatorRequest->getOriginAddress()->toNode($xml));

        // Translate
        $trackRequest->appendChild($locatorRequest->getTranslate()->toNode($xml));

        // Unit of measurement
        if ($locatorRequest->getUnitOfMeasurement()) {
            $trackRequest->appendChild($locatorRequest->getUnitOfMeasurement()->toNode($xml));
        }

        // LocationSearchCriteria
        if ($locatorRequest->getLocationSearchCriteria()) {
            $trackRequest->appendChild($locatorRequest->getLocationSearchCriteria()->toNode($xml));
        }

        return $xml->saveXML();
    }

    private function formatResponse(SimpleXMLElement $response)
    {
        unset($response->Response);

        return $this->convertXmlObject($response);
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        if (null === $this->request) {
            $this->request = new Request($this->logger);
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
