<?php

use backend\Controller\UserController;

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . "/Controller/UserController.php";

$method = $_SERVER['REQUEST_METHOD'];
$userController = new UserController();

if ($method === 'OPTIONS') {
    http_response_code(200);
    exit;
}

switch ($method) {
    case 'GET':
        if (isset($_GET['email'])) {
            $userController->getUserByEmail($_GET['email']);
        } else {
            $userController->getUsers();
        }
        break;

    case 'POST':
        $userController->addUser();
        break;

    case 'PUT':
        if (isset($_GET['email'])) {
            $userController->updateUser($_GET['email']);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Email parameter is required"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['email'])) {
            $userController->deleteUser($_GET['email']);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Email parameter is required"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}
