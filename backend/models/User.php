<?php

// User.php
namespace backend\models;

require_once __DIR__ . '/../config/Database.php';


class User
{
    private $firstName;
    private $lastName;
    private $email;
    private $companyName;
    private $position;
    private $phones;

    public function __construct($firstName, $lastName, $email, $companyName = null, $position = null, $phones = [])
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->companyName = $companyName;
        $this->position = $position;
        $this->phones = $phones;
    }

    // Геттеры

    public function getFirstName()
    {
        return $this->firstName;
    }


    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }


    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setCompanyName(mixed $companyName): void
    {
        $this->companyName = $companyName;
    }


    public function setPosition(mixed $position): void
    {
        $this->position = $position;
    }

    public function setPhones(mixed $phones): void
    {
        $this->phones = $phones;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getPhones()
    {
        return $this->phones;
    }

}