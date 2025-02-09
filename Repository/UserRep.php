<?php

namespace Repository;

use Database;
use PDO;
use User;

require_once 'config/Database.php';
require_once 'models/User.php';

class UserRep
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Посмотреть всех аккаунтов
    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Посмотреть одного юзера
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Добавить
    public function addUser(User $user)
    {
        $sql = "INSERT INTO users 
                (first_name, last_name, email, company_name, position, phone1, phone2, phone3) 
                VALUES (:first_name, :last_name, :email, :company_name, :position, :phone1, :phone2, :phone3)";
        $stmt = $this->db->prepare($sql);

        $firstname=$user->getFirstName();
        $lastname=$user->getLastName();
        $email = $user->getEmail();
        $position = $user->getPosition();

        $stmt->bindParam(':first_name', $firstname);
        $stmt->bindParam(':last_name', $lastname);
        $stmt->bindParam(':new_email', $email);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':email', $email);

        $phones = $user->getPhones();
        $phone1 = $phones[0] ?? null;
        $phone2 = $phones[1] ?? null;
        $phone3 = $phones[2] ?? null;

        $stmt->bindParam(':phone1', $phone1);
        $stmt->bindParam(':phone2', $phone2);
        $stmt->bindParam(':phone3', $phone3);

        return $stmt->execute();
    }

    // Изменить данные юзера по почте
    public function updateUser(User $user, $email)
    {
        $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :new_email, position = :position, phone1 = :phone1, phone2 = :phone2, phone3 = :phone3 WHERE email = :email";
        $stmt = $this->db->prepare($sql);

        $firstname=$user->getFirstName();
        $lastname=$user->getLastName();
        $email = $user->getEmail();
        $position = $user->getPosition();

        $stmt->bindParam(':first_name', $firstname);
        $stmt->bindParam(':last_name', $lastname);
        $stmt->bindParam(':new_email', $email);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':email', $email);

        $phones = $user->getPhones();
        $phone1 = $phones[0] ?? null;
        $phone2 = $phones[1] ?? null;
        $phone3 = $phones[2] ?? null;

        $stmt->bindParam(':phone1', $phone1);
        $stmt->bindParam(':phone2', $phone2);
        $stmt->bindParam(':phone3', $phone3);

        return $stmt->execute();
    }

    // Удаление по почте
    public function deleteUser($email)
    {
        $sql = "DELETE FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
