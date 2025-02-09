<?php

// User.php
class User {
    private $firstName;
    private $lastName;
    private $email;
    private $companyName;
    private $position;
    private $phones;

    public function __construct($firstName, $lastName, $email, $companyName = null, $position = null, $phones = []) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->companyName = $companyName;
        $this->position = $position;
        $this->phones = $phones;
    }

    // Геттеры
    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function getPosition() {
        return $this->position;
    }

    public function getPhones() {
        return $this->phones;
    }

}