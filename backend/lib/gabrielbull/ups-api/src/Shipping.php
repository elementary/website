<?php

namespace Ups;

use DOMDocument;
use DOMNode;
use Exception;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use SimpleXMLElement;
use Ups\Entity\Shipment;
use Ups\Entity\ShipmentRequestLabelSpecification;
use Ups\Entity\ShipmentRequestReceiptSpecification;

/**
 * Package Shipping API Wrapper
 * Based on UPS Developer Guide, dated: 31 Dec 2012.
 */
class Shipping extends Ups
{
    const REQ_VALIDATE = 'validate';
    const REQ_NONVALIDATE = 'nonvalidate';

    /**
     * @var string
     */
    private $shipConfirmEndpoint = '/ShipConfirm';

    /**
     * @var string
     */
    private $shipAcceptEndpoint = '/ShipAccept';

    /**
     * @var string
     */
    private $voidEndpoint = '/Void';

    /**
     * @var string
     */
    private $recoverLabelEndpoint = '/LabelRecovery';

    private $request;

    /**
     * @param string|null $accessKey UPS License Access Key
     * @param string|null $userId UPS User ID
     * @param string|null $password UPS User Password
     * @param bool $useIntegration Determine if we should use production or CIE URLs.
     * @param RequestInterface|null $request
     * @param LoggerInterface|null PSR3 compatible logger (optional)
     */
    public function __construct($accessKey = null, $userId = null, $password = null, $useIntegration = false, RequestInterface $request = null, LoggerInterface $logger = null)
    {
        if (null !== $request) {
            $this->setRequest($request);
        }
        parent::__construct($accessKey, $userId, $password, $useIntegration, $logger);
    }

    /**
     * Create a Shipment Confirm request (generate a digest).
     *
     * @param string $validation A UPS_Shipping::REQ_* constant (or null)
     * @param Shipment $shipment Shipment data container.
     * @param ShipmentRequestLabelSpecification|null $labelSpec LabelSpecification data. Optional
     * @param ShipmentRequestReceiptSpecification|null $receiptSpec ShipmentRequestReceiptSpecification data. Optional
     *
     * @throws Exception
     *
     * @return stdClass
     */
    public function confirm(
        $validation,
        Shipment $shipment,
        ShipmentRequestLabelSpecification $labelSpec = null,
        ShipmentRequestReceiptSpecification $receiptSpec = null
    ) {
        $request = $this->createConfirmRequest($validation, $shipment, $labelSpec, $receiptSpec);
        $this->response = $this->getRequest()->request($this->createAccess(), $request, $this->compileEndpointUrl($this->shipConfirmEndpoint));
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
     * Creates a ShipConfirm request.
     *
     * @param string $validation
     * @param Shipment $shipment
     * @param ShipmentRequestLabelSpecification|null $labelSpec
     * @param ShipmentRequestReceiptSpecification|null $receiptSpec
     *
     * @return string
     */
    private function createConfirmRequest(
        $validation,
        Shipment $shipment,
        ShipmentRequestLabelSpecification $labelSpec = null,
        ShipmentRequestReceiptSpecification $receiptSpec = null
    ) {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        // Page 45
        $container = $xml->appendChild($xml->createElement('ShipmentConfirmRequest'));

        // Page 45
        $request = $container->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'ShipConfirm'));
        $request->appendChild($xml->createElement('RequestOption', $validation ?: 'nonvalidate'));

        // Page 47
        $shipmentNode = $container->appendChild($xml->createElement('Shipment'));

        if ($shipment->getDescription()) {
            $shipmentNode->appendChild($xml->createElement('Description', $shipment->getDescription()));
        }

        $returnService = $shipment->getReturnService();
        if (isset($returnService)) {
            $node = $shipmentNode->appendChild($xml->createElement('ReturnService'));

            $node->appendChild($xml->createElement('Code', $returnService->getCode()));
        }

        if ($shipment->getDocumentsOnly()) {
            $shipmentNode->appendChild($xml->createElement('DocumentsOnly'));
        }

        $shipperNode = $shipmentNode->appendChild($xml->createElement('Shipper'));

        $shipperNode->appendChild($xml->createElement('Name', $shipment->getShipper()->getName()));

        if ($shipment->getShipper()->getAttentionName()) {
            $shipperNode->appendChild($xml->createElement('AttentionName', $shipment->getShipper()->getAttentionName()));
        }

        if ($shipment->getShipper()->getCompanyName()) {
            $shipperNode->appendChild($xml->createElement('CompanyDisplayableName', $shipment->getShipper()->getCompanyName()));
        }

        $shipperNode->appendChild($xml->createElement('ShipperNumber', $shipment->getShipper()->getShipperNumber()));

        if ($shipment->getShipper()->getTaxIdentificationNumber()) {
            $shipperNode->appendChild($xml->createElement('TaxIdentificationNumber', $shipment->getShipper()->getTaxIdentificationNumber()));
        }

        if ($shipment->getShipper()->getPhoneNumber()) {
            $shipperNode->appendChild($xml->createElement('PhoneNumber', $shipment->getShipper()->getPhoneNumber()));
        }

        if ($shipment->getShipper()->getFaxNumber()) {
            $shipperNode->appendChild($xml->createElement('FaxNumber', $shipment->getShipper()->getFaxNumber()));
        }

        if ($shipment->getShipper()->getEMailAddress()) {
            $shipperNode->appendChild($xml->createElement('EMailAddress', $shipment->getShipper()->getEMailAddress()));
        }

        $shipperNode->appendChild($shipment->getShipper()->getAddress()->toNode($xml));

        $shipToNode = $shipmentNode->appendChild($xml->createElement('ShipTo'));

        $shipToNode->appendChild($xml->createElement('CompanyName', $shipment->getShipTo()->getCompanyName()));

        if ($shipment->getShipTo()->getAttentionName()) {
            $shipToNode->appendChild($xml->createElement('AttentionName', $shipment->getShipTo()->getAttentionName()));
        }

        if ($shipment->getShipTo()->getPhoneNumber()) {
            $shipToNode->appendChild($xml->createElement('PhoneNumber', $shipment->getShipTo()->getPhoneNumber()));
        }

        if ($shipment->getShipTo()->getFaxNumber()) {
            $shipToNode->appendChild($xml->createElement('FaxNumber', $shipment->getShipTo()->getFaxNumber()));
        }

        if ($shipment->getShipTo()->getEMailAddress()) {
            $shipToNode->appendChild($xml->createElement('EMailAddress', $shipment->getShipTo()->getEMailAddress()));
        }

        $addressNode = $shipment->getShipTo()->getAddress()->toNode($xml);

        if ($shipment->getShipTo()->getLocationID()) {
            $addressNode->appendChild($xml->createElement('LocationID', strtoupper($shipment->getShipTo()->getLocationID())));
        }

        $shipToNode->appendChild($addressNode);

        if ($shipment->getShipFrom()) {
            $shipFromNode = $shipmentNode->appendChild($xml->createElement('ShipFrom'));

            $shipFromNode->appendChild($xml->createElement('CompanyName', $shipment->getShipFrom()->getCompanyName()));

            if ($shipment->getShipFrom()->getAttentionName()) {
                $shipFromNode->appendChild($xml->createElement('AttentionName', $shipment->getShipFrom()->getAttentionName()));
            }

            if ($shipment->getShipFrom()->getPhoneNumber()) {
                $shipFromNode->appendChild($xml->createElement('PhoneNumber', $shipment->getShipFrom()->getPhoneNumber()));
            }

            if ($shipment->getShipFrom()->getFaxNumber()) {
                $shipFromNode->appendChild($xml->createElement('FaxNumber', $shipment->getShipFrom()->getFaxNumber()));
            }

            $shipFromNode->appendChild($shipment->getShipFrom()->getAddress()->toNode($xml));
        }

        if ($shipment->getSoldTo()) {
            $soldToNode = $shipmentNode->appendChild($xml->createElement('SoldTo'));

            if ($shipment->getSoldTo()->getOption()) {
                $soldToNode->appendChild($xml->createElement('Option', $shipment->getSoldTo()->getOption()));
            }

            $soldToNode->appendChild($xml->createElement('CompanyName', $shipment->getSoldTo()->getCompanyName()));

            if ($shipment->getSoldTo()->getAttentionName()) {
                $soldToNode->appendChild($xml->createElement('AttentionName', $shipment->getSoldTo()->getAttentionName()));
            }

            if ($shipment->getSoldTo()->getPhoneNumber()) {
                $soldToNode->appendChild($xml->createElement('PhoneNumber', $shipment->getSoldTo()->getPhoneNumber()));
            }

            if ($shipment->getSoldTo()->getFaxNumber()) {
                $soldToNode->appendChild($xml->createElement('FaxNumber', $shipment->getSoldTo()->getFaxNumber()));
            }

            if ($shipment->getSoldTo()->getAddress()) {
                $soldToNode->appendChild($shipment->getSoldTo()->getAddress()->toNode($xml));
            }
        }

        $alternate = $shipment->getAlternateDeliveryAddress();
        if (isset($alternate)) {
            $shipmentNode->appendChild($alternate->toNode($xml));
        }

        if ($shipment->getPaymentInformation()) {
            $paymentNode = $shipmentNode->appendChild($xml->createElement('PaymentInformation'));

            if ($shipment->getPaymentInformation()->getPrepaid()) {
                $node = $paymentNode->appendChild($xml->createElement('Prepaid'));
                $node = $node->appendChild($xml->createElement('BillShipper'));

                $billShipper = $shipment->getPaymentInformation()->getPrepaid()->getBillShipper();
                if (isset($billShipper) && $shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getAccountNumber()) {
                    $node->appendChild($xml->createElement('AccountNumber', $shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getAccountNumber()));
                } elseif (isset($billShipper) && $shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getCreditCard()) {
                    $ccNode = $node->appendChild($xml->createElement('CreditCard'));
                    $ccNode->appendChild($xml->createElement('Type', $shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getCreditCard()->getType()));
                    $ccNode->appendChild($xml->createElement('Number', $shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getCreditCard()->getNumber()));
                    $ccNode->appendChild($xml->createElement('ExpirationDate', $shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getCreditCard()->getExpirationDate()));

                    if ($shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getCreditCard()->getSecurityCode()) {
                        $ccNode->appendChild($xml->createElement('SecurityCode', $shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getCreditCard()->getSecurityCode()));
                    }

                    if ($shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getCreditCard()->getAddress()) {
                        $ccNode->appendChild($shipment->getPaymentInformation()->getPrepaid()->getBillShipper()->getCreditCard()->getAddress()->toNode($xml));
                    }
                }
            } elseif ($shipment->getPaymentInformation()->getBillThirdParty()) {
                $node = $paymentNode->appendChild($xml->createElement('BillThirdParty'));
                $btpNode = $node->appendChild($xml->createElement('BillThirdPartyShipper'));
                $btpNode->appendChild($xml->createElement('AccountNumber', $shipment->getPaymentInformation()->getBillThirdParty()->getAccountNumber()));

                $tpNode = $btpNode->appendChild($xml->createElement('ThirdParty'));
                $addressNode = $tpNode->appendChild($xml->createElement('Address'));

                $thirdPartAddress = $shipment->getPaymentInformation()->getBillThirdParty()->getThirdPartyAddress();
                if (isset($thirdPartAddress) && $shipment->getPaymentInformation()->getBillThirdParty()->getThirdPartyAddress()->getPostalCode()) {
                    $addressNode->appendChild($xml->createElement('PostalCode', $shipment->getPaymentInformation()->getBillThirdParty()->getThirdPartyAddress()->getPostalCode()));
                }

                $addressNode->appendChild($xml->createElement('CountryCode', $shipment->getPaymentInformation()->getBillThirdParty()->getThirdPartyAddress()->getCountryCode()));
            } elseif ($shipment->getPaymentInformation()->getFreightCollect()) {
                $node = $paymentNode->appendChild($xml->createElement('FreightCollect'));
                $brNode = $node->appendChild($xml->createElement('BillReceiver'));
                $brNode->appendChild($xml->createElement('AccountNumber', $shipment->getPaymentInformation()->getFreightCollect()->getAccountNumber()));

                if ($shipment->getPaymentInformation()->getFreightCollect()->getBillReceiverAddress()) {
                    $addressNode = $brNode->appendChild($xml->createElement('Address'));
                    $addressNode->appendChild($xml->createElement('PostalCode', $shipment->getPaymentInformation()->getFreightCollect()->getBillReceiverAddress()->getPostalCode()));
                }
            } elseif ($shipment->getPaymentInformation()->getConsigneeBilled()) {
                $paymentNode->appendChild($xml->createElement('ConsigneeBilled'));
            }
//         TODO: create ItemizedPaymentInformation class and required subclasses for node processing
//        } elseif ($shipment->getItemizedPaymentInformation()) {
//            $paymentNode = $shipmentNode->appendChild($xml->createElement('ItemizedPaymentInformation'));
        }

        if ($shipment->getGoodsNotInFreeCirculationIndicator()) {
            $shipmentNode->appendChild($xml->createElement('GoodsNotInFreeCirculationIndicator'));
        }

        if ($shipment->getMovementReferenceNumber()) {
            $shipmentNode->appendChild($xml->createElement('MovementReferenceNumber', $shipment->getMovementReferenceNumber()));
        }

        $serviceNode = $shipmentNode->appendChild($xml->createElement('Service'));
        $serviceNode->appendChild($xml->createElement('Code', $shipment->getService()->getCode()));

        if ($shipment->getService()->getDescription()) {
            $serviceNode->appendChild($xml->createElement('Description', $shipment->getService()->getDescription()));
        }

        if ($shipment->getInvoiceLineTotal()) {
            $shipmentNode->appendChild($shipment->getInvoiceLineTotal()->toNode($xml));
        }

        if ($shipment->getNumOfPiecesInShipment()) {
            $shipmentNode->appendChild($xml->createElement('NumOfPiecesInShipment', $shipment->getNumOfPiecesInShipment()));
        }

        if ($shipment->getRateInformation()) {
            $node = $shipmentNode->appendChild($xml->createElement('RateInformation'));
            $node->appendChild($xml->createElement('NegotiatedRatesIndicator'));
        }

        foreach ($shipment->getPackages() as $package) {
            $shipmentNode->appendChild($xml->importNode($package->toNode($xml), true));
        }

        $shipmentServiceOptions = $shipment->getShipmentServiceOptions();
        if (isset($shipmentServiceOptions)) {
            $shipmentNode->appendChild($shipmentServiceOptions->toNode($xml));
        }

        $referenceNumber = $shipment->getReferenceNumber();
        if (isset($referenceNumber)) {
            $shipmentNode->appendChild($referenceNumber->toNode($xml));
        }
        
        $referenceNumber2 = $shipment->getReferenceNumber2();
        if (isset($referenceNumber2)) {
            $shipmentNode->appendChild($referenceNumber2->toNode($xml));
        }

        if ($labelSpec) {
            $container->appendChild($xml->importNode($this->compileLabelSpecificationNode($labelSpec), true));
        }

        $shipmentIndicationType = $shipment->getShipmentIndicationType();
        if (isset($shipmentIndicationType)) {
            $shipmentNode->appendChild($shipmentIndicationType->toNode($xml));
        }

        if ($receiptSpec) {
            $container->appendChild($xml->importNode($this->compileReceiptSpecificationNode($receiptSpec), true));
        }

        return $xml->saveXML();
    }

    /**
     * Create a Shipment Accept request (generate a shipping label).
     *
     * @param string $shipmentDigest The UPS Shipment Digest received from a ShipConfirm request.
     *
     * @throws Exception
     *
     * @return \stdClass
     */
    public function accept($shipmentDigest)
    {
        $request = $this->createAcceptRequest($shipmentDigest);
        $this->response = $this->getRequest()->request($this->createAccess(), $request, $this->compileEndpointUrl($this->shipAcceptEndpoint));
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
            return $this->formatResponse($response->ShipmentResults);
        }
    }

    /**
     * Creates a ShipAccept request.
     *
     * @param string $shipmentDigest
     *
     * @return string
     */
    private function createAcceptRequest($shipmentDigest)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $container = $xml->appendChild($xml->createElement('ShipmentAcceptRequest'));
        $request = $container->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'ShipAccept'));
        $container->appendChild($xml->createElement('ShipmentDigest', $shipmentDigest));

        return $xml->saveXML();
    }

    /**
     * Void a shipping label / request.
     *
     * @param string|array $shipmentData Either the UPS Shipment Identification Number or an array of
     *                                   expanded shipment data [shipmentId:, trackingNumbers:[...]]
     *
     * @throws Exception
     *
     * @return \stdClass
     */
    public function void($shipmentData)
    {
        if (is_array($shipmentData) && !isset($shipmentData['shipmentId'])) {
            throw new InvalidArgumentException('$shipmentData parameter is required to contain a key `shipmentId`.');
        }

        $request = $this->createVoidRequest($shipmentData);
        $this->response = $this->getRequest()->request($this->createAccess(), $request, $this->compileEndpointUrl($this->voidEndpoint));
        $response = $this->response->getResponse();

        if ($response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        } else {
            unset($response->Response);

            return $this->formatResponse($response);
        }
    }

    /**
     * Creates a void shipment request.
     *
     * @param string|array $shipmentData
     *
     * @return string
     */
    private function createVoidRequest($shipmentData)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $container = $xml->appendChild($xml->createElement('VoidShipmentRequest'));
        $request = $container->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', '1'));

        if (is_string($shipmentData)) {
            $container->appendChild($xml->createElement('ShipmentIdentificationNumber', strtoupper($shipmentData)));
        } else {
            $expanded = $container->appendChild($xml->createElement('ExpandedVoidShipment'));
            $expanded->appendChild($xml->createElement('ShipmentIdentificationNumber', strtoupper($shipmentData['shipmentId'])));

            if (array_key_exists('trackingNumbers', $shipmentData)) {
                foreach ($shipmentData['trackingNumbers'] as $tn) {
                    $expanded->appendChild($xml->createElement('TrackingNumber', strtoupper($tn)));
                }
            }
        }

        return $xml->saveXML();
    }

    /**
     * Recover a shipping label.
     *
     * @param string|array $trackingData Either the tracking number or a map of ReferenceNumber data
     *                                         [value:, shipperNumber:]
     * @param array|null $labelSpecification Map of label specification data for this request. Optional.
     *                                         [userAgent:, imageFormat: 'HTML|PDF']
     * @param array|null $labelDelivery All elements are optional. [link:]
     * @param array|null $translate Map of translation data. Optional. [language:, dialect:]
     *
     * @throws Exception|InvalidArgumentException
     *
     * @return \stdClass
     */
    public function recoverLabel($trackingData, $labelSpecification = null, $labelDelivery = null, $translate = null)
    {
        if (is_array($trackingData)) {
            if (!isset($trackingData['value'])) {
                throw new InvalidArgumentException('$trackingData parameter is required to contain `value`.');
            }

            if (!isset($trackingData['shipperNumber'])) {
                throw new InvalidArgumentException('$trackingData parameter is required to contain `shipperNumber`.');
            }
        }

        if (!empty($translate)) {
            if (!isset($translateOpts['language'])) {
                $translateOpts['language'] = 'eng';
            }

            if (!isset($translateOpts['dialect'])) {
                $translateOpts['dialect'] = 'US';
            }
        }

        $request = $this->createRecoverLabelRequest($trackingData, $labelSpecification, $labelDelivery, $translate);
        $response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl($this->recoverLabelEndpoint));

        if ($response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        } else {
            unset($response->Response);

            return $this->formatResponse($response);
        }
    }

    /**
     * Creates a label recovery request.
     *
     * @param string|array $trackingData
     * @param array|null $labelSpecificationOpts
     * @param array|null $labelDeliveryOpts
     * @param array|null $translateOpts
     *
     * @return string
     */
    private function createRecoverLabelRequest($trackingData, $labelSpecificationOpts = null, $labelDeliveryOpts = null, $translateOpts = null)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $container = $xml->appendChild($xml->createElement('LabelRecoveryRequest'));
        $request = $container->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'LabelRecovery'));

        if (!empty($labelSpecificationOpts)) {
            $labelSpec = $request->appendChild($xml->createElement('LabelSpecification'));

            if (isset($labelSpecificationOpts['userAgent'])) {
                $labelSpec->appendChild($xml->createElement('HTTPUserAgent', $labelSpecificationOpts['userAgent']));
            }

            if (isset($labelSpecificationOpts['imageFormat'])) {
                $format = $labelSpec->appendChild($xml->createElement('LabelImageFormat'));
                $format->appendChild($xml->createElement('Code', $labelSpecificationOpts['imageFormat']));
            }
        }

        if (!empty($labelDeliveryOpts)) {
            $labelDelivery = $request->appendChild($xml->createElement('LabelDelivery'));
            $labelDelivery->appendChild($xml->createElement('LabelLinkIndicator', $labelDeliveryOpts['link']));
        }

        if (!empty($translateOpts)) {
            $translate = $request->appendChild($xml->createElement('Translate'));
            $translate->appendChild($xml->createElement('LanguageCode', $translateOpts['language']));
            $translate->appendChild($xml->createElement('DialectCode', $translateOpts['dialect']));
            $translate->appendChild($xml->createElement('Code', '01'));
        }

        return $xml->saveXML();
    }

    /**
     * Format the response.
     *
     * @param SimpleXMLElement $response
     *
     * @return \stdClass
     */
    private function formatResponse(SimpleXMLElement $response)
    {
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

    /**
     * @param ShipmentRequestReceiptSpecification $receiptSpec
     * @return DOMNode
     */
    private function compileReceiptSpecificationNode(ShipmentRequestReceiptSpecification $receiptSpec)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $receiptSpecNode = $xml->appendChild($xml->createElement('ReceiptSpecification'));

        $imageFormatNode = $receiptSpecNode->appendChild($xml->createElement('ImageFormat'));
        $imageFormatNode->appendChild($xml->createElement('Code', $receiptSpec->getImageFormatCode()));

        if ($receiptSpec->getImageFormatDescription()) {
            $imageFormatNode->appendChild($xml->createElement('Description', $receiptSpec->getImageFormatDescription()));
        }

        return $receiptSpecNode->cloneNode(true);
    }

    /**
     * @param ShipmentRequestLabelSpecification $labelSpec
     * @return DOMNode
     */
    private function compileLabelSpecificationNode(ShipmentRequestLabelSpecification $labelSpec)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $labelSpecNode = $xml->appendChild($xml->createElement('LabelSpecification'));

        $printMethodNode = $labelSpecNode->appendChild($xml->createElement('LabelPrintMethod'));
        $printMethodNode->appendChild($xml->createElement('Code', $labelSpec->getPrintMethodCode()));

        if ($labelSpec->getPrintMethodDescription()) {
            $printMethodNode->appendChild($xml->createElement('Description', $labelSpec->getPrintMethodDescription()));
        }

        if ($labelSpec->getHttpUserAgent()) {
            $labelSpecNode->appendChild($xml->createElement('HTTPUserAgent', $labelSpec->getHttpUserAgent()));
        }

        //Label print method is required only for GIF label formats
        if ($labelSpec->getPrintMethodCode() == ShipmentRequestLabelSpecification::IMG_FORMAT_CODE_GIF) {
            $imageFormatNode = $labelSpecNode->appendChild($xml->createElement('LabelImageFormat'));
            $imageFormatNode->appendChild($xml->createElement('Code', $labelSpec->getImageFormatCode()));

            if ($labelSpec->getImageFormatDescription()) {
                $imageFormatNode->appendChild($xml->createElement('Description', $labelSpec->getImageFormatDescription()));
            }
        } else {
            //Label stock size is required only for non-GIF label formats
            $stockSizeNode = $labelSpecNode->appendChild($xml->createElement('LabelStockSize'));

            $stockSizeNode->appendChild($xml->createElement('Height', $labelSpec->getStockSizeHeight()));
            $stockSizeNode->appendChild($xml->createElement('Width', $labelSpec->getStockSizeWidth()));
        }

        if ($labelSpec->getInstructionCode()) {
            $instructionNode = $labelSpecNode->appendChild($xml->createElement('Instruction'));
            $instructionNode->appendChild($xml->createElement('Code', $labelSpec->getInstructionCode()));

            if ($labelSpec->getInstructionDescription()) {
                $instructionNode->appendChild($xml->createElement('Description', $labelSpec->getInstructionDescription()));
            }
        }

        return $labelSpecNode->cloneNode(true);
    }
}
