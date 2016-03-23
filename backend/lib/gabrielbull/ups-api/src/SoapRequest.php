<?php

namespace Ups;

use DateTime;
use Exception;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use SimpleXMLElement;
use SoapClient;
use Ups\Exception\InvalidResponseException;

class SoapRequest implements RequestInterface, LoggerAwareInterface
{
    /**
     * @var string
     */
    protected $access;

    /**
     * @var string
     */
    protected $request;

    /**
     * @var string
     */
    protected $endpointUrl;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger !== null) {
            $this->setLogger($logger);
        } else {
            $this->setLogger(new NullLogger);
        }
    }

    /**
     * Sets a logger instance on the object.
     *
     * @param LoggerInterface $logger
     *
     * @return null
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Send request to UPS.
     *
     * @param string $access The access request xml
     * @param string $request The request xml
     * @param string $endpointurl The UPS API Endpoint URL
     * @param string $operation Operation to perform on SOAP endpoint
     * @param string $wsdl Which WSDL file to use
     *
     * @throws Exception
     * @todo: make access, request and endpointurl nullable to make the testable
     *
     * @return ResponseInterface
     */
    public function request($access, $request, $endpointurl, $operation = null, $wsdl = null)
    {
        // Check for operation
        if (is_null($operation)) {
            throw new \Exception('Operation is required');
        }

        // Check for WSDL
        if (is_null($wsdl)) {
            throw new \Exception('WSDL is required');
        }

        // Set data
        $this->setAccess($access);
        $this->setRequest($request);
        $this->setEndpointUrl($endpointurl);

        // Settings based on UPS PHP Example
        $mode = array(
            'soap_version' => 'SOAP_1_1',
            'trace' => 1,
            'connection_timeout' => 2,
            'cache_wsdl' => WSDL_CACHE_BOTH,
        );

        // Initialize soap client
        $client = new SoapClient(__DIR__ . '/WSDL/' . $wsdl . '.wsdl', $mode);

        // Set endpoint URL + auth & request data
        $client->__setLocation($endpointurl);
        $auth = (array)new SimpleXMLElement($access);
        $request = (array)new SimpleXMLElement($request);

        // Build auth header
        $header = new \SoapHeader('http://www.ups.com/schema/xpci/1.0/auth', 'AccessRequest', $auth);
        $client->__setSoapHeaders($header);

        // Log request
        $date = new DateTime();
        $id = $date->format('YmdHisu');
        $this->logger->info('Request To UPS API', [
            'id' => $id,
            'endpointurl' => $this->getEndpointUrl(),
        ]);

        $this->logger->debug('Request: ' . $this->getRequest(), [
            'id' => $id,
            'endpointurl' => $this->getEndpointUrl(),
        ]);

        // Perform call and get response
        try {
            $request = json_decode(json_encode((array)$request), true);
            $client->__soapCall($operation, [$request]);
            $body = $client->__getLastResponse();

            $this->logger->info('Response from UPS API', [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            $this->logger->debug('Response: ' . $body, [
                'id' => $id,
                'endpointurl' => $this->getEndpointUrl(),
            ]);

            // Strip off namespaces and make XML
            $body = preg_replace('/(<\/*)[^>:]+:/', '$1', $body);
            $xml = new SimpleXMLElement($body);
            $responseInstance = new Response();
            return $responseInstance->setText($body)->setResponse($xml);
        } catch (\Exception $e) {
            // Parse error response
            $xml = new SimpleXMLElement($client->__getLastResponse());
            $xml->registerXPathNamespace('err', 'http://www.ups.com/schema/xpci/1.0/error');
            $errorCode = $xml->xpath('//err:PrimaryErrorCode/err:Code');
            $errorMsg = $xml->xpath('//err:PrimaryErrorCode/err:Description');

            if (isset($errorCode[0]) && isset($errorMsg[0])) {
                $this->logger->alert($errorMsg[0], [
                    'id' => $id,
                    'endpointurl' => $this->getEndpointUrl(),
                ]);

                throw new InvalidResponseException('Failure: ' . (string)$errorMsg[0] . ' (' . (string)$errorCode[0] . ')');
            } else {
                $this->logger->alert($e->getMessage(), [
                    'id' => $id,
                    'endpointurl' => $this->getEndpointUrl(),
                ]);

                throw new InvalidResponseException('Cannot parse error from UPS: ' . $e->getMessage(), $e->getCode(),
                    $e);
            }
        }
    }

    /**
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->endpointUrl;
    }

    /**
     * @param $endpointUrl
     *
     * @return $this
     */
    public function setEndpointUrl($endpointUrl)
    {
        $this->endpointUrl = $endpointUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $request
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param $access
     *
     * @return $this
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }
}
