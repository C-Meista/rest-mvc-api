<?php
define('ROOT_DIR', __DIR__ . "/");

require_once ROOT_DIR . "Controller/SystemController.php";
require_once ROOT_DIR . "DB.php";

DB::connect();

// wichtig
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$uri = substr($_SERVER['REQUEST_URI'], 1);

$controller = new SystemController();

$params = explode('/', $uri);

if ($method === 'GET') {

    if ($params[0] == 'users' && count($params) < 2) {
        $controller->showAllUsers();
    } elseif ($params[0] == 'users' && count($params) == 2) {
        $controller->showUser($params[1]);
    }

} elseif ($method === 'POST') {

    if ($params[0] == 'users' && count($params) < 2) {
        $controller->createUser();
    }

} elseif ($method === 'PUT') {

    if ($params[0] == 'users' && count($params) == 2) {
        $controller->modifyUser($params[1]);
    }

} elseif ($method === 'DELETE') {

    if ($params[0] == 'users' && count($params) == 2) {
        $controller->deleteUser($params[1]);
    }

} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
}