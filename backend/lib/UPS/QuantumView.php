<?php

namespace Ups;

use ArrayObject;
use DOMDocument;
use Exception;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;

/**
 * Quantum View API Wrapper.
 */
class QuantumView extends Ups
{
    const ENDPOINT = '/QVEvents';

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     *                        todo: make private
     */
    public $response;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $beginDateTime;

    /**
     * @var string
     */
    private $endDateTime;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $bookmark;

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
     * Get a QuantumView subscription.
     *
     * @param string $name Name of subscription requested by user.
     * @param string $beginDateTime Beginning date time for the retrieval criteria of the subscriptions. Format: Y-m-d H:i:s or Unix timestamp.
     * @param string $endDateTime Ending date time for the retrieval criteria of the subscriptions. Format: Y-m-d H:i:s or Unix timestamp.
     * @param string $fileName File name of specific subscription requested by user.
     * @param string $bookmark Bookmarks the file for next retrieval.
     *
     * @throws Exception
     *
     * @return ArrayObject
     */
    public function getSubscription($name = null, $beginDateTime = null, $endDateTime = null, $fileName = null, $bookmark = null)
    {
        // Format date times
        if (null !== $beginDateTime) {
            $beginDateTime = $this->formatDateTime($beginDateTime);
        }

        if (null !== $endDateTime) {
            $endDateTime = $this->formatDateTime($endDateTime);
        }

        // If user provided a begin date time but no end date time, we assume the end date time is now
        if (null !== $beginDateTime && null === $endDateTime) {
            $endDateTime = $this->formatDateTime(time());
        }

        $this->name = $name;
        $this->beginDateTime = $beginDateTime;
        $this->endDateTime = $endDateTime;
        $this->fileName = $fileName;
        $this->bookmark = $bookmark;

        // Create request
        $access = $this->createAccess();
        $request = $this->createRequest();

        $this->response = $this->getRequest()->request($access, $request, $this->compileEndpointUrl(self::ENDPOINT));
        $response = $this->response->getResponse();

        if (null === $response) {
            throw new Exception('Failure (0): Unknown error', 0);
        }

        if ($response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        } else {
            if (isset($response->Bookmark)) {
                $this->setBookmark((string)$response->Bookmark);
            } else {
                $this->setBookmark(null);
            }

            return $this->formatResponse($response);
        }
    }

    /**
     * Create the QuantumView request.
     *
     * @return string
     */
    private function createRequest()
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        // Create the QuantumViewRequest element
        $quantumViewRequest = $xml->appendChild($xml->createElement('QuantumViewRequest'));
        $quantumViewRequest->setAttribute('xml:lang', 'en-US');

        // Create the SubscriptionRequest element
        if (null !== $this->name || null !== $this->beginDateTime || null !== $this->fileName) {
            $subscriptionRequest = $quantumViewRequest->appendChild($xml->createElement('SubscriptionRequest'));

            // Subscription name
            if (null !== $this->name) {
                $subscriptionRequest->appendChild($xml->createElement('Name', $this->name));
            }

            // Date Time Range
            if (null !== $this->beginDateTime) {
                $dateTimeRange = $subscriptionRequest->appendChild($xml->createElement('DateTimeRange'));
                $dateTimeRange->appendChild($xml->createElement('BeginDateTime', $this->beginDateTime));
                $dateTimeRange->appendChild($xml->createElement('EndDateTime', $this->endDateTime));

                // File name
            } elseif (null !== $this->fileName) {
                $subscriptionRequest->appendChild($xml->createElement('FileName', $this->fileName));
            }
        }

        // Create the Bookmark element
        if (null !== $this->bookmark) {
            $quantumViewRequest->appendChild($xml->createElement('Bookmark', $this->bookmark));
        }

        // Create the Request element
        $request = $quantumViewRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'QVEvents'));

        return $xml->saveXML();
    }

    /**
     * Format the response.
     *
     * @param SimpleXMLElement $response
     *
     * @return ArrayObject
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        $eventsException = ['FileName', 'StatusType'];
        $output = new ArrayObject();

        // Empty response?
        if (!isset($response->QuantumViewEvents->SubscriptionEvents->SubscriptionFile)) {
            return $output;
        }

        // Loop subscription files
        foreach ($response->QuantumViewEvents->SubscriptionEvents->SubscriptionFile as $subcriptionFile) {
            foreach ($subcriptionFile as $eventName => $event) {
                if (!in_array($eventName, $eventsException)) {
                    $event = $this->convertXmlObject($event);
                    $event = (object)array_merge(
                        ['Type' => $eventName],
                        (array)$event
                    );
                    $output->append($event);
                }
            }
        }

        return $output;
    }

    /**
     * Return true if request has a bookmark.
     *
     * @return bool
     */
    public function hasBookmark()
    {
        return null !== $this->bookmark;
    }

    /**
     * Return the bookmark.
     *
     * @return string|null
     */
    public function getBookmark()
    {
        return $this->bookmark;
    }

    /**
     * @param string|null $bookmark
     *
     * @return $this
     */
    public function setBookmark($bookmark)
    {
        $this->bookmark = $bookmark;

        return $this;
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
