<?php

namespace Ups;

use DOMDocument;
use Exception;
use SimpleXMLElement;
use Ups\Entity\LabelRecoveryRequest;
use Ups\Entity\LabelRecoveryResponse;

/**
 * LabelRecovery API Wrapper.
 *
 * @author Sebastien Vergnes <sebastien@vergnes.eu>
 */
class LabelRecovery extends Ups
{
    const ENDPOINT = '/LabelRecovery';

    /**
     * @param $shipment
     *
     * @throws Exception
     *
     * @return LabelRecoveryResponse
     */
    public function getLabelRecovery($shipment)
    {
        return $this->sendRequest($shipment);
    }

    /**
     * Creates and sends a request for the given shipment. This handles checking for
     * errors in the response back from UPS.
     *
     * @param $labelRecoveryRequest
     *
     * @throws Exception
     *
     * @return LabelRecoveryResponse
     */
    private function sendRequest($labelRecoveryRequest)
    {
        $request = $this->createRequest($labelRecoveryRequest);
        $response = $this->request($this->createAccess(), $request, $this->compileEndpointUrl(self::ENDPOINT));

        if ($response->Response->ResponseStatusCode == 0) {
            throw new Exception(
                "Failure ({$response->Response->Error->ErrorSeverity}): {$response->Response->Error->ErrorDescription}",
                (int)$response->Response->Error->ErrorCode
            );
        } else {
            return $this->formatResponse($response);
        }
    }

    /**
     * Create the LabelRecovery request.
     *
     * @param LabelRecoveryRequest $labelRecoveryRequest The request details. Refer to the UPS documentation for available structure
     *
     * @return string
     */
    private function createRequest($labelRecoveryRequest)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;

        $trackRequest = $xml->appendChild($xml->createElement('LabelRecoveryRequest'));
        $trackRequest->setAttribute('xml:lang', 'en-US');

        $request = $trackRequest->appendChild($xml->createElement('Request'));

        $node = $xml->importNode($this->createTransactionNode(), true);
        $request->appendChild($node);

        $request->appendChild($xml->createElement('RequestAction', 'LabelRecovery'));

        $labelSpecificationNode = $trackRequest->appendChild($xml->createElement('LabelSpecification'));
        if (isset($labelRecoveryRequest->LabelSpecification)) {
            $labelSpecificationNode->appendChild($xml->createElement('HTTPUserAgent', $labelRecoveryRequest->LabelSpecification->HTTPUserAgent));
            $labelImageFormatNode = $labelSpecificationNode->appendChild($xml->createElement('LabelImageFormat'));
            $labelImageFormatNode->appendChild($xml->createElement('Code', $labelRecoveryRequest->LabelSpecification->LabelImageFormat->Code));
        }

        if (isset($labelRecoveryRequest->Translate)) {
            $translateNode = $trackRequest->appendChild($xml->createElement('Translate'));
            $translateNode->appendChild($xml->createElement('LanguageCode', $labelRecoveryRequest->Translate->LanguageCode));
            $translateNode->appendChild($xml->createElement('DialectCode', $labelRecoveryRequest->Translate->DialectCode));
            $translateNode->appendChild($xml->createElement('Code', $labelRecoveryRequest->Translate->Code));
        }

        if (isset($labelRecoveryRequest->LabelLinkIndicator)) {
            $labelLinkIndicatorNode = $trackRequest->appendChild($xml->createElement('LabelLinkIndicator'));
            $labelLinkIndicatorNode->appendChild($xml->createElement('LabelLinkIndicator'));
        }

        if (isset($labelRecoveryRequest->TrackingNumber)) {
            $trackRequest->appendChild($xml->createElement('TrackingNumber', $labelRecoveryRequest->TrackingNumber));
        }

        if (isset($labelRecoveryRequest->ReferenceNumber)) {
            $referenceNumberNode = $trackRequest->appendChild($xml->createElement('ReferenceNumber'));
            $referenceNumberNode->appendChild($xml->createElement('Value', $labelRecoveryRequest->ReferenceNumber->Value));
        }

        if (isset($labelRecoveryRequest->ShipperNumber)) {
            $trackRequest->appendChild($xml->createElement('ShipperNumber', $labelRecoveryRequest->ShipperNumber));
        }

        return $xml->saveXML();
    }

    /**
     * Format the response.
     *
     * @param SimpleXMLElement $response
     *
     * @return LabelRecoveryResponse
     */
    private function formatResponse(SimpleXMLElement $response)
    {
        // We don't need to return data regarding the response to the user
        unset($response->Response);

        $result = $this->convertXmlObject($response);

        return new LabelRecoveryResponse($result->LabelRecoveryResponse);
    }
}
