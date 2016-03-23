<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class Package implements NodeInterface
{
    const PKG_OVERSIZE1 = '1';
    const PKG_OVERSIZE2 = '2';
    const PKG_LARGE = '4';

    /**
     * @var PackagingType
     */
    private $packagingType;

    /**
     * @var PackageWeight
     */
    private $packageWeight;

    /**
     * @var string
     */
    private $description;

    /**
     * @var PackageServiceOptions
     */
    private $packageServiceOptions;

    /**
     * @var string
     */
    private $upsPremiumCareIndicator;

    /**
     * @var ReferenceNumber
     */
    private $referenceNumber;

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var bool
     */
    private $isLargePackage;

    /**
     * @var bool
     */
    private $additionalHandling;

    /**
     * @var Dimensions|null
     */
    private $dimensions;

    /**
     * @var Activity[]
     */
    private $activities = [];

    /**
     * @param null|object $attributes
     */
    public function __construct($attributes = null)
    {
        $this->setPackagingType(new PackagingType(
            isset($attributes->PackagingType) ? $attributes->PackagingType : null)
        );
        $this->setReferenceNumber(new ReferenceNumber());
        $this->setPackageWeight(new PackageWeight());
        $this->setPackageServiceOptions(new PackageServiceOptions());

        if (null !== $attributes) {
            if (isset($attributes->PackageWeight)) {
                $this->setPackageWeight(new PackageWeight($attributes->PackageWeight));
            }
            if (isset($attributes->Description)) {
                $this->setDescription($attributes->Description);
            }
            if (isset($attributes->PackageServiceOptions)) {
                $this->setPackageServiceOptions(new PackageServiceOptions($attributes->PackageServiceOptions));
            }
            if (isset($attributes->UPSPremiumCareIndicator)) {
                $this->setUpsPremiumCareIndicator($attributes->UPSPremiumCareIndicator);
            }
            if (isset($attributes->ReferenceNumber)) {
                $this->setReferenceNumber(new ReferenceNumber($attributes->ReferenceNumber));
            }
            if (isset($attributes->TrackingNumber)) {
                $this->setTrackingNumber($attributes->TrackingNumber);
            }
            if (isset($attributes->LargePackage)) {
                $this->setLargePackage($attributes->LargePackage);
            }
            if (isset($attributes->Dimensions)) {
                $this->setDimensions(new Dimensions($attributes->Dimensions));
            }
            if (isset($attributes->Activity)) {
                $activities = $this->getActivities();
                if (is_array($attributes->Activity)) {
                    foreach ($attributes->Activity as $Activity) {
                        $activities[] = new Activity($Activity);
                    }
                } else {
                    $activities[] = new Activity($attributes->Activity);
                }
                $this->setActivities($activities);
            }
        }
    }

    /**
     * @param null|DOMDocument $document
     *
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $packageNode = $document->createElement('Package');

        if ($this->getDescription()) {
            $packageNode->appendChild($document->createElement('Description', $this->getDescription()));
        }
        $packageNode->appendChild($this->getPackagingType()->toNode($document));
        $packageNode->appendChild($this->getPackageWeight()->toNode($document));


        if (null !== $this->getDimensions()) {
            $packageNode->appendChild($this->getDimensions()->toNode($document));
        }

        if ($this->isLargePackage()) {
            $packageNode->appendChild($document->createElement('LargePackageIndicator'));
        }

        if ($this->getAdditionalHandling()) {
            $packageNode->appendChild($document->createElement('AdditionalHandling'));
        }

        if ($this->getPackageServiceOptions()) {
            $packageNode->appendChild($this->getPackageServiceOptions()->toNode($document));
        }

        if ($this->getReferenceNumber()
            && !is_null($this->getReferenceNumber()->getCode())
            && !is_null($this->getReferenceNumber()->getValue())
        ) {
            $packageNode->appendChild($this->getReferenceNumber()->toNode($document));
        }

        return $packageNode;
    }

    /**
     * @return Activity[]
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * @param Activity[] $activities
     *
     * @return Package
     */
    public function setActivities(array $activities)
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Package
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Dimensions|null
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param Dimensions $dimensions
     *
     * @return Package
     */
    public function setDimensions(Dimensions $dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * @return bool
     */
    public function isLargePackage()
    {
        return $this->isLargePackage;
    }

    /**
     * @param bool $largePackage
     *
     * @return Package
     */
    public function setLargePackage($largePackage)
    {
        $this->isLargePackage = $largePackage;

        return $this;
    }

    /**
     * @return PackageServiceOptions
     */
    public function getPackageServiceOptions()
    {
        return $this->packageServiceOptions;
    }

    /**
     * @param PackageServiceOptions $packageServiceOptions
     *
     * @return Package
     */
    public function setPackageServiceOptions(PackageServiceOptions $packageServiceOptions)
    {
        $this->packageServiceOptions = $packageServiceOptions;

        return $this;
    }

    /**
     * @return PackageWeight
     */
    public function getPackageWeight()
    {
        return $this->packageWeight;
    }

    /**
     * @param PackageWeight $packageWeight
     *
     * @return Package
     */
    public function setPackageWeight(PackageWeight $packageWeight)
    {
        $this->packageWeight = $packageWeight;

        return $this;
    }

    /**
     * @return PackagingType
     */
    public function getPackagingType()
    {
        return $this->packagingType;
    }

    /**
     * @param PackagingType $packagingType
     *
     * @return Package
     */
    public function setPackagingType(PackagingType $packagingType)
    {
        $this->packagingType = $packagingType;

        return $this;
    }

    /**
     * @return ReferenceNumber
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param ReferenceNumber $referenceNumber
     *
     * @return Package
     */
    public function setReferenceNumber(ReferenceNumber $referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;

        return $this;
    }

    public function removeReferenceNumber()
    {
        $this->referenceNumber = null;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     *
     * @return Package
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpsPremiumCareIndicator()
    {
        return $this->upsPremiumCareIndicator;
    }

    /**
     * @param string $upsPremiumCareIndicator
     *
     * @return Package
     */
    public function setUpsPremiumCareIndicator($upsPremiumCareIndicator)
    {
        $this->upsPremiumCareIndicator = $upsPremiumCareIndicator;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAdditionalHandling()
    {
        return $this->additionalHandling;
    }

    /**
     * @param boolean $additionalHandling
     */
    public function setAdditionalHandling($additionalHandling)
    {
        $this->additionalHandling = $additionalHandling;
    }
}
