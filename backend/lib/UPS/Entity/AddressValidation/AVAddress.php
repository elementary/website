<?php namespace Ups\Entity\AddressValidation;

class AVAddress
{
    /**
     * @var null|AddressClassification
     */
    public $addressClassification;
    /**
     * @var string
     */
    public $consigneeName;
    /**
     * @var string
     */
    public $buildingName;
    /**
     * @var string
     */
    public $addressLine;
    /**
     * @var string
     */
    public $addressLine2;
    /**
     * @var string
     */
    public $addressLine3;
    /**
     * @var string
     */
    public $region;
    /**
     * @var string
     */
    public $politicalDivision2;
    /**
     * @var string
     */
    public $politicalDivision1;
    /**
     * @var string
     */
    public $postcodePrimaryLow;
    /**
     * @var string
     */
    public $postcodeExtendedLow;
    /**
     * @var string
     */
    public $urbanization;
    /**
     * @var
     */
    public $countryCode;

    /**
     * Address constructor.
     * @param \SimpleXMLElement $xmlDoc
     */
    public function __construct(\SimpleXMLElement $xmlDoc)
    {
        if ($xmlDoc->count() == 0) {
            throw new \InvalidArgumentException(__METHOD__ . ': The passed object does not have any child nodes.');
        }
        $this->addressClassification = isset($xmlDoc->AddressClassification) ? new AddressClassification($xmlDoc->AddressClassification) : null;
        $this->consigneeName = isset($xmlDoc->ConsigneeName) ? (string)$xmlDoc->ConsigneeName : '';
        $this->buildingName = isset($xmlDoc->BuildingName) ? (string)$xmlDoc->BuildingName : '';
        if (isset($xmlDoc->AddressLine)) {
            for ($i = 0, $len = count($xmlDoc->AddressLine); $i < $len; $i++) {
                $var = 'addressLine' . ($i > 0 ? $i + 1 : '');
                $this->{$var} = isset($xmlDoc->AddressLine[$i]) ? (string) $xmlDoc->AddressLine[$i] : '';
            }
        }
        $this->region = isset($xmlDoc->Region) ? (string)$xmlDoc->Region : '';
        $this->politicalDivision2 = isset($xmlDoc->PoliticalDivision2) ? (string)$xmlDoc->PoliticalDivision2 : '';
        $this->politicalDivision1 = isset($xmlDoc->PoliticalDivision1) ? (string)$xmlDoc->PoliticalDivision1 : '';
        $this->postcodePrimaryLow = isset($xmlDoc->PostcodePrimaryLow) ? (string)$xmlDoc->PostcodePrimaryLow : '';
        $this->postcodeExtendedLow = isset($xmlDoc->PostcodeExtendedLow) ? (string)$xmlDoc->PostcodeExtendedLow : '';
        $this->urbanization = isset($xmlDoc->Urbanization) ? (string)$xmlDoc->Urbanization : '';
        $this->countryCode = isset($xmlDoc->CountryCode) ? (string)$xmlDoc->CountryCode : '';
    }

    /**
     * Convenience methods. Even though all properties are public, these methods provide a convenient interface to
     * retrieve commonly requested parts so that the user doesn't have to remember which API fields reference
     * which piece of information. For example, I won't have to remember that the city is in 'PoliticalDivision2'.
     */

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->politicalDivision2;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getConsigneeName()
    {
        return $this->consigneeName;
    }

    /**
     * @return string
     */
    public function getUrbanization()
    {
        return $this->urbanization;
    }

    /**
     * @return string
     */
    public function getBuildingName()
    {
        return $this->buildingName;
    }

    /**
     * @return string
     */
    public function getStateProvince()
    {
        return $this->politicalDivision1;
    }

    /**
     * Return the address postal code
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postcodePrimaryLow;
    }

    /**
     * Return the address postal code with extension (i.e. the U.S. extended zip+4 postal code)
     *
     * @param string $divider
     * @return string
     */
    public function getPostalCodeWithExtension($divider = '-')
    {
        return $this->postcodePrimaryLow . $divider . $this->postcodeExtendedLow;
    }

    /**
     * @return string
     *
     * @param int $lineNumber
     * @return string
     */
    public function getAddressLine($lineNumber = 1)
    {
        $var = 'addressLine' . ($lineNumber > 1 ? $lineNumber : '');
        return $this->{$var};
    }
}
