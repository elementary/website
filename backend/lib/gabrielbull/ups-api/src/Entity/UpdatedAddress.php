<?php

namespace Ups\Entity;

class UpdatedAddress
{
    /**
     * @var
     */
    public $AddressLine1;

    /**
     * @var
     */
    public $AddressLine2;

    /**
     * @var
     */
    public $AddressLine3;

    /**
     * @var
     */
    public $City;

    /**
     * @var
     */
    public $StateProvinceCode;

    /**
     * @var
     */
    public $PostalCode;

    /**
     * @var
     */
    public $CountryCode;

    /**
     * @var
     */
    public $PoliticalDivision1;

    /**
     * @var
     */
    public $PoliticalDivision2;

    /**
     * @var
     */
    public $PoliticalDivision3;

    /**
     * @var
     */
    public $PostcodePrimaryLow;

    /**
     * @var
     */
    public $PostcodePrimaryHigh;

    /**
     * @var
     */
    public $PostcodeExtendedLow;

    /**
     * @var
     */
    public $ResidentialAddressIndicator;

    /**
     * @var
     */
    public $ConsigneeName;

    /**
     * @var
     */
    public $StreetNumberLow;

    /**
     * @var
     */
    public $StreetPrefix;

    /**
     * @var
     */
    public $StreetName;

    /**
     * @var
     */
    public $StreetType;

    /**
     * @var
     */
    public $StreetSuffix;

    /**
     * @var
     */
    public $BuildingName;

    /**
     * @var array
     */
    public $AddressExtendedInformation;

    /**
     * @param null $response
     */
    public function __construct($response = null)
    {
        $this->AddressExtendedInformation = [];

        if (null != $response) {
            if (isset($response->AddressLine1)) {
                $this->AddressLine1 = $response->AddressLine1;
            }
            if (isset($response->AddressLine2)) {
                $this->AddressLine2 = $response->AddressLine2;
            }
            if (isset($response->AddressLine3)) {
                $this->AddressLine3 = $response->AddressLine3;
            }
            if (isset($response->City)) {
                $this->City = $response->City;
            }
            if (isset($response->StateProvinceCode)) {
                $this->StateProvinceCode = $response->StateProvinceCode;
            }
            if (isset($response->PostalCode)) {
                $this->PostalCode = $response->PostalCode;
            }
            if (isset($response->CountryCode)) {
                $this->CountryCode = $response->CountryCode;
            }
            if (isset($response->PoliticalDivision1)) {
                $this->PoliticalDivision1 = $response->PoliticalDivision1;
            }
            if (isset($response->PoliticalDivision2)) {
                $this->PoliticalDivision2 = $response->PoliticalDivision2;
            }
            if (isset($response->PoliticalDivision3)) {
                $this->PoliticalDivision3 = $response->PoliticalDivision3;
            }
            if (isset($response->PostcodePrimaryLow)) {
                $this->PostcodePrimaryLow = $response->PostcodePrimaryLow;
            }
            if (isset($response->PostcodePrimaryHigh)) {
                $this->PostcodePrimaryHigh = $response->PostcodePrimaryHigh;
            }
            if (isset($response->PostcodeExtendedLow)) {
                $this->PostcodeExtendedLow = $response->PostcodeExtendedLow;
            }
            if (isset($response->ResidentialAddressIndicator)) {
                $this->ResidentialAddressIndicator = $response->ResidentialAddressIndicator;
            }
            if (isset($response->ConsigneeName)) {
                $this->ConsigneeName = $response->ConsigneeName;
            }
            if (isset($response->StreetNumberLow)) {
                $this->StreetNumberLow = $response->StreetNumberLow;
            }
            if (isset($response->StreetPrefix)) {
                $this->StreetPrefix = $response->StreetPrefix;
            }
            if (isset($response->StreetName)) {
                $this->StreetName = $response->StreetName;
            }
            if (isset($response->StreetType)) {
                $this->StreetType = $response->StreetType;
            }
            if (isset($response->StreetSuffix)) {
                $this->StreetSuffix = $response->StreetSuffix;
            }
            if (isset($response->BuildingName)) {
                $this->BuildingName = $response->BuildingName;
            }
            if (isset($response->AddressExtendedInformation)) {
                foreach ($response->AddressExtendedInformation as $AddressExtendedInformation) {
                    $this->AddressExtendedInformation[] = new AddressExtendedInformation($AddressExtendedInformation);
                }
            }
        }
    }
}
