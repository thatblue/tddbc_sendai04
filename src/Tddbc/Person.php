<?php
namespace Tddbc;

use \InvalidArgumentException;

class Person
{
    protected $family_name;
    protected $first_name;
    protected $gender;

    const MALE = 1;
    const FEMALE = 2;

    public function __construct($family_name, $first_name, $gender)
    {
        if(empty($family_name) || !is_string($family_name)) {
            throw new InvalidArgumentException('family name is invalid');
        }

        if(empty($first_name) || !is_string($first_name)) {
            throw new InvalidArgumentException('first name is invalid');
        }

        if(empty($gender) || !in_array($gender, array(static::MALE, static::FEMALE))) {
            throw new InvalidArgumentException('gender is invalid');
        }

        $this->family_name = $family_name;
        $this->first_name = $first_name;
        $this->gender = $gender;
    }

    public function getFamilyName()
    {
        return $this->family_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getFullName()
    {
        return $this->family_name . $this->first_name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function isMarriageable(Person $targetPerson)
    {
        return $this->gender !== $targetPerson->getGender();
    }
}
