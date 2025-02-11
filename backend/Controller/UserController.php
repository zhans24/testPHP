<?php

namespace backend\Controller;

use backend\Repository\UserRep;
use backend\models\User;
use backend\Controller\interface\ControllerInterface;

require_once __DIR__ . '/../Repository/UserRep.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/interface/ControllerInterface.php';

class UserController implements ControllerInterface
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRep();
    }

    // Получить всех пользователей
    public function show()
    {
        echo json_encode($this->userRepo->getUsers());
    }

    // Найти пользователя по email
    public function find($email)
    {
        $user = $this->userRepo->getUserByEmail($email);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["ошибка" => "Нет такого юзера"]);
        }
    }

    // Добавить нового пользователя
    public function save($data)
    {
        $user = new User(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['company_name'] ?? null,
            $data['position'] ?? null,
            $data['phones'] ?? []
        );

        if ($this->userRepo->addUser($user)) {
            echo json_encode(["message" => "Юзер добавлен"]);
        } else {
            http_response_code(500);
            echo json_encode(["ошибка" => "Не добавлен юзер"]);
        }
    }

    // Обновить данные пользователя
    public function update($data, $email)
    {
        $user = new User(
            $data['first_name'],
            $data['last_name'],
            $email,
            $data['company_name'] ?? null,
            $data['position'] ?? null,
            $data['phones'] ?? []
        );

        if ($this->userRepo->updateUser($user, $email)) {
            echo json_encode(["message" => "Юзер обновлен"]);
        } else {
            http_response_code(500);
            echo json_encode(["ошибка" => "Ошибка в обновлении"]);
        }
    }

    // Удалить пользователя
    public function delete($email)
    {
        if ($this->userRepo->deleteUser($email)) {
            echo json_encode(["message" => "Юзер удален"]);
        } else {
            http_response_code(500);
            echo json_encode(["ошибка" => "Ошибка в удалении"]);
        }
    }
}
