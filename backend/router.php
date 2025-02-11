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

$data = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['email'])) {
            $userController->find($_GET['email']);
        } else {
            $userController->show();
        }
        break;

    case 'POST':
        $userController->save($data);
        break;

    case 'PUT':
        $userController->update($data,$_GET['email']);
        break;

    case 'DELETE':
        $userController->delete($_GET['email']);
        break;

    default:
        http_response_code(405);
        echo json_encode(["ошибка" => "Нет разрешении для этого метода"]);
}
