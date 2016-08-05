<?php

namespace Ups;

use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use stdClass;
use DateTime;

/**
 * Tracking API Wrapper.
 */
class Tracking extends Ups
{
    const ENDPOINT = '/Track';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     *                        // todo make private
     */
    public $response;

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $referenceNumber;

    /**
     * @var string
     */
    private $requestOption;

    /**
     * @var string
     */
    private $shipperNumber;

    /**
     * @var \DateTime
     */
    private $beginDate;

    /**
     * @var \DateTime
     */
    private $endDate;

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
     * Get package tracking information.
     *
     * @param string $trackingNumber The package's tracking number.
     * @param string $requestOption Optional processing. For Mail Innovations the only valid options are Last Activity and All activity.
     *
     * @throws Exception
     *
     * @return stdClass
     */
    public function track($trackingNumber, $requestOption = 'activity')
    {
        $this->trackingNumber = $trackingNumber;
        $this->requestOption = $requestOption;

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
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Get package tracking information.
     *
     * @param string $referenceNumber Reference numbers can be a purchase order number, job number, etc. Reference number can be added when creating a shipment.
     * @param string $requestOption
     *
     * @throws Exception
     *
     * @return stdClass
     */
    public function trackByReference($referenceNumber, $requestOption = 'activity')
    {
        $this->referenceNumber = $referenceNumber;
        $this->requestOption = $requestOption;

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
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Set shipper number
     *
     * @param string $shipperNumber
     *
     */
    public function setShipperNumber($shipperNumber)
    {
        $this->shipperNumber = $shipperNumber;
    }

    /**
     * Set begin date
     *
     * @param string $beginDate
     *
     */
    public function setBeginDate(DateTime $beginDate)
    {
        $this->beginDate = $beginDate;
    }

    /**
     * Set end date
     *
     * @param string $endDate
     *
     */
    public function setEndDate(DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * Check if tracking number is for mail innovations.
     *
     * @return bool
     */
    private function isMailInnovations()
    {
        $patterns = [

            // UPS Mail Innovations tracking numbers
            '/^MI\d{6}\d{1,22}$/',// MI 000000 00000000+

            // USPS - Certified Mail
            '/^94071\d{17}$/',    // 9407 1000 0000 0000 0000 00
            '/^7\d{19}$/',        // 7000 0000 0000 0000 0000

            // USPS - Collect on Delivery
            '/^93033\d{17}$/',    // 9303 3000 0000 0000 0000 00
            '/^M\d{9}$/',         // M000 0000 00

            // USPS - Global Express Guaranteed
            '/^82\d{10}$/',       // 82 000 000 00

            // USPS - Priority Mail Express International
            '/^EC\d{9}US$/',      // EC 000 000 000 US

            // USPS - Priority Mail Express
            '/^927\d{19}$/',      // 9270 1000 0000 0000 0000 00
            '/^EA\d{9}US$/',      // EA 000 000 000 US

            // USPS - Priority Mail International
            '/^CP\d{9}US$/',      // CP 000 000 000 US

            // USPS - Priority Mail
            '/^92055\d{17}$/',    // 9205 5000 0000 0000 0000 00
            '/^14\d{18}$/',       // 1400 0000 0000 0000 0000

            // USPS - Registered Mail
            '/^92088\d{17}$/',    // 9208 8000 0000 0000 0000 00
            '/^RA\d{9}US$/',      // RA 000 000 000 US

            // USPS - Signature Confirmation
            '/^9202\d{16}US$/',   // 9202 1000 0000 0000 0000 00
            '/^23\d{16}US$/',     // 2300 0000 0000 0000 0000

            // USPS - Tracking
            '/^94\d{20}$/',       // 9400 1000 0000 0000 0000 00
            '/^03\d{18}$/'        // 0300 0000 0000 0000 0000
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $this->trackingNumber)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Create the Tracking request.
     *
     * @return string
     */
    private function createRequest()
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $trackRequest = $xml->appendChild($xml->createElement('TrackRequest'));
        $trackRequest->setAttribute('xml:lang', 'en-US');

        $request = $trackRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'Track'));

        if (null !== $this->requestOption) {
            $request->appendChild($xml->createElement('RequestOption', $this->requestOption));
        }

        if (null !== $this->trackingNumber) {
            $trackRequest->appendChild($xml->createElement('TrackingNumber', $this->trackingNumber));
        }

        if ($this->isMailInnovations()) {
            $trackRequest->appendChild($xml->createElement('IncludeMailInnovationIndicator'));
        }

        if (null !== $this->referenceNumber) {
            $trackRequest->appendChild($xml->createElement('ReferenceNumber'))->appendChild($xml->createElement('Value', $this->referenceNumber));
        }

        if (null !== $this->shipperNumber) {
            $trackRequest->appendChild($xml->createElement('ShipperNumber', $this->shipperNumber));
        }

        if (null !== $this->beginDate) {
            $beginDate = $this->beginDate->format('Ymd');
            $trackRequest->appendChild($xml->createElement('BeginDate', $beginDate));
        }

        if (null !== $this->endDate) {
            $endDate = $this->endDate->format('Ymd');
            $trackRequest->appendChild($xml->createElement('EndDate', $endDate));
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
        return $this->convertXmlObject($response->Shipment);
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
