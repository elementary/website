<?php namespace Ups\Entity\AddressValidation;

class AddressClassification
{
    public $code;
    public $description;

    public function __construct(\SimpleXMLElement $object)
    {
        if ($object->count() == 0) {
            throw new \InvalidArgumentException(__METHOD__ . ': The passed object does not have any child nodes.');
        }
        $this->code = $object->Code;
        $this->description = $object->Description;
    }
}
