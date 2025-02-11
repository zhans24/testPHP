<?php

namespace backend\Controller;

use backend\Repository\UserRep;
use backend\models\User;

require_once __DIR__ . '/../Repository/UserRep.php';
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $userRepo;

    public function __construct() {
        $this->userRepo = new UserRep();
    }

    public function getUsers() {
        echo json_encode($this->userRepo->getUsers());
    }

    public function getUserByEmail($email) {
        $user = $this->userRepo->getUserByEmail($email);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "User not found"]);
        }
    }

    public function addUser() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['first_name'], $data['last_name'], $data['email'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

        $user = new User(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['company_name'] ?? null,
            $data['position'] ?? null,
            $data['phones'] ?? []
        );

        if ($this->userRepo->addUser($user)) {
            echo json_encode(["message" => "User added successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to add user"]);
        }
    }

    public function updateUser($email) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['first_name'], $data['last_name'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

        $user = new User(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['company_name'] ?? null,
            $data['position'] ?? null,
            $data['phones'] ?? []
        );

        if ($this->userRepo->updateUser($user, $email)) {
            echo json_encode(["message" => "User updated successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to update user"]);
        }
    }

    public function deleteUser($email) {
        if ($this->userRepo->deleteUser($email)) {
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to delete user"]);
        }
    }
}
