<?php

class Pandemic
{
    private $name, $type, $discoveryYear, $description, $creator;

    public function __construct($name, $type, $discoveryYear, $description, $creator)
    {
        $this->setName($name);
        $this->setType($type);
        $this->setDiscoveryYear($discoveryYear);
        $this->setDescription($description);
        $this->setCreator($creator);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDiscoveryYear()
    {
        return $this->discoveryYear;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCreator()
    {
        return $this->creator;
    }

    public function setName($name)
    {
        if (!self::isNameValid($name)) {
            throw new Exception("Invalid name");
        }
        $this->name = $name;
    }

    public function setType($type)
    {
        if (!self::isTypeValid($type)) {
            throw new Exception("Invalid type");
        }
        $this->type = $type;
    }

    public function setDiscoveryYear($discoveryYear)
    {
        if (!self::isDiscoveryYearValid($discoveryYear)) {
            throw new Exception("Invalid discovery year");
        }
        $this->discoveryYear = $discoveryYear;
    }

    public function setDescription($description)
    {
        if (!self::isDescriptionValid($description)) {
            throw new Exception("Invalid description");
        }
        $this->description = $description;
    }

    public function setCreator($creator)
    {
        if (!self::isCreatorValid($creator)) {
            throw new Exception("Invalid creator");
        }
        $this->creator = $creator;
    }


    public static function isNameValid($name)
    {
        return is_string($name) && $name !== "";
    }

    public static function isTypeValid($type)
    {
        return is_string($type) && $type !== "";
    }

    public static function isDiscoveryYearValid($discoveryYear)
    {
        return is_integer($discoveryYear);
    }

    public static function isDescriptionValid($description)
    {
        return is_string($description) && $description !== "";
    }

    public static function isCreatorValid($creator)
    {
        return is_string($creator) && $creator !== "";
    }
}
