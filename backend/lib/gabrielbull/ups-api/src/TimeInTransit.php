<?php

namespace Ups;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Ups\Entity\TimeInTransitRequest;
use Ups\Entity\TimeInTransitResponse;

/**
 * TimeInTransit API Wrapper.
 *
 * @author Sebastien Vergnes <sebastien@vergnes.eu>
 */
class TimeInTransit extends Ups
{
    private $request;

    const ENDPOINT = '/TimeInTransit';

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface|null $request
     * @param LoggerInterface|null $logger PSR3 compatible logger (optional)
     */
    public function __construct($accessKey = null, $userId = null, $password = null, $useIntegration = false, RequestInterface $request = null, LoggerInterface $logger = null)
    {
        if (null !== $request) {
            $this->setRequest($request);
        }
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * @param TimeInTransitRequest $shipment
     *
     * @throws Exception
     *
     * @return TimeInTransitRequest
     */
    public function getTimeInTransit(TimeInTransitRequest $shipment)
    {
        return $this->sendRequest($shipment);
    }

    /**
     * Creates and sends a request for the given shipment. This handles checking for
     * errors in the response back from UPS.
     *
     * @param TimeInTransitRequest $timeInTransitRequest
     *
     * @throws Exception
     *
     * @return TimeInTransitRequest
     */
    private function sendRequest(TimeInTransitRequest $timeInTransitRequest)
    {
        $request = $this->createRequest($timeInTransitRequest);
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
     * @param TimeInTransitRequest $timeInTransitRequest The request details. Refer to the UPS documentation for available structure
     *
     * @return string
     */
    private function createRequest(TimeInTransitRequest $timeInTransitRequest)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $trackRequest = $xml->appendChild($xml->createElement('TimeInTransitRequest'));
        $trackRequest->setAttribute('xml:lang', 'en-US');

        $request = $trackRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'TimeInTransit'));

        $transitFromNode = $trackRequest->appendChild($xml->createElement('TransitFrom'));
        $address = $timeInTransitRequest->getTransitFrom();
        if (isset($address)) {
            $transitFromNode->appendChild($address->toNode($xml));
        }

        $transitToNode = $trackRequest->appendChild($xml->createElement('TransitTo'));
        $address = $timeInTransitRequest->getTransitTo();
        if (isset($address)) {
            $transitToNode->appendChild($address->toNode($xml));
        }

        $weight = $timeInTransitRequest->getShipmentWeight();
        if (isset($weight)) {
            $trackRequest->appendChild($weight->toNode($xml));
        }

        $packages = $timeInTransitRequest->getTotalPackagesInShipment();
        if (isset($packages)) {
            $trackRequest->appendChild($xml->createElement('TotalPackagesInShipment', $packages));
        }

        $invoiceLineTotal = $timeInTransitRequest->getInvoiceLineTotal();
        if (isset($invoiceLineTotal)) {
            $trackRequest->appendChild($invoiceLineTotal->toNode($xml));
        }

        $pickupDate = $timeInTransitRequest->getPickupDate();
        if ($pickupDate) {
            $trackRequest->appendChild($xml->createElement('PickupDate', $pickupDate->format('Ymd')));
        }

        $indicator = $timeInTransitRequest->getDocumentsOnlyIndicator();
        if ($indicator) {
            $trackRequest->appendChild($xml->createElement('DocumentsOnlyIndicator'));
        }

        return $xml->saveXML();
    }

    /**
     * Format the response.
     *
     * @param SimpleXMLElement $response
     *
     * @return TimeInTransitRequest
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        // We don't need to return data regarding the response to the user
        unset($response->Response);

        $result = $this->convertXmlObject($response);

        // Fix for when one ServiceSummary while expecting an array in later responses - easiest place to fix here
        if (isset($result->TransitResponse->ServiceSummary->Service)) {
            $result->TransitResponse->ServiceSummary = array($result->TransitResponse->ServiceSummary);
        }

        return new TimeInTransitResponse($result->TransitResponse);
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
