<?php

namespace Ups;

use DOMNode;
use stdClass;

class Utilities
{
    /**
     * Generates a standard <Address> node for requests.
     *
     * @param stdClass $address An address data structure
     * @param DOMNode $element
     *
     * @deprecated Use NodeInterface on entities instead
     */
    public static function addAddressNode(&$address, DOMNode $element)
    {
        $node = $element->appendChild($element->ownerDocument->createElement('Address'));
        self::appendChild($address, 'AddressLine1', $node);
        self::appendChild($address, 'AddressLine2', $node);
        self::appendChild($address, 'AddressLine3', $node);
        self::appendChild($address, 'City', $node);
        self::appendChild($address, 'StateProvinceCode', $node);
        self::appendChild($address, 'PostalCode', $node);
        self::appendChild($address, 'CountryCode', $node);
    }

    /**
     * Generates an artifact <Address> node for requests.
     *
     * @param stdClass $address An address data structure
     * @param DOMNode $element
     *
     * @deprecated Use NodeInterface on entities instead
     */
    public static function addAddressArtifactNode(&$address, DOMNode $element)
    {
        $node = $element->appendChild($element->ownerDocument->createElement('AddressArtifactFormat'));
        self::appendChild($address, 'CountryCode', $node);
        self::appendChild($address, 'PoliticalDivision1', $node);
        self::appendChild($address, 'PoliticalDivision2', $node);
        self::appendChild($address, 'PostcodePrimaryLow', $node);
    }

    /**
     * Adds location information including company name, attention name and address.
     *
     * @param $location
     * @param DOMNode $locationNode
     *
     * @deprecated Use NodeInterface on entities instead
     */
    public static function addLocationInformation($location, DOMNode $locationNode)
    {
        self::appendChild($location, 'CompanyName', $locationNode);
        self::appendChild($location, 'AttentionName', $locationNode);

        if (isset($location->Address)) {
            self::addAddressNode($location->Address, $locationNode);
        }
    }

    /**
     * @param $shipment
     * @param DOMNode $node
     *
     * @deprecated Use NodeInterface on entities instead
     */
    public static function addPackages($shipment, DOMNode $node)
    {
        foreach ($shipment->Package as $package) {
            $packageNode = $node->appendChild($node->ownerDocument->createElement('Package'));

            if (isset($package->PackagingType)) {
                $packagingType = $packageNode->appendChild($node->ownerDocument->createElement('PackagingType'));
                self::appendChild($package->PackagingType, 'Code', $packagingType);
                self::appendChild($package->PackagingType, 'Description', $packagingType);
            }

            $pwNode = $packageNode->appendChild($node->ownerDocument->createElement('PackageWeight'));

            if (isset($package->PackageWeight)) {
                self::appendChild($package->PackageWeight, 'Weight', $pwNode);
                if (isset($package->PackageWeight->UnitOfMeasurement)) {
                    // Add the UnitOfMeasurement children nodes Code and Description
                    self::appendChild($package->PackageWeight->UnitOfMeasurement, 'Code', $pwNode);
                    self::appendChild($package->PackageWeight->UnitOfMeasurement, 'Description', $pwNode);
                }
            }
        }
    }

    /**
     * Conditionally adds a child node to $node. The value comes from the specified $object
     * and will only be added if the $propertyName has a value.
     *
     * @param stdClass $object The object to get values from
     * @param string $propertyName The property name to access
     * @param DOMNode $node The node to add the child to
     *
     * @deprecated Use NodeInterface on entities instead
     */
    public static function appendChild($object, $propertyName, DOMNode $node)
    {
        if (isset($object->{$propertyName})) {
            $node->appendChild($node->ownerDocument->createElement($propertyName, $object->{$propertyName}));
        }
    }
}
