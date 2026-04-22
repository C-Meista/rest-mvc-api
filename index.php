<?php
define('ROOT_DIR', __DIR__ . "/");

//alle 3
require_once ROOT_DIR . "Controllers/Controller.php";
require_once ROOT_DIR . "DB.php";

//Require once etc. replacable with one method (see autoload)

DB::connect();

// wichtig
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$uri = substr($_SERVER['REQUEST_URI'], 1);

$controller = new Controller();

$params = explode('/', $uri);

if ($method === 'GET') {

    //statische router klasse OPTIMIEREN ABFRAGEN (alto router etc)

    if ($params[0] == 'users'||$params[0] == 'products' && count($params) < 2) {
        $controller->getAll($params[0]);
    } elseif ($params[0] == 'users'||$params[0] == 'products' && count($params) == 2) {
        $controller->get($params[0],$params[1]);
    }

} elseif ($method === 'POST') {

    if ($params[0] == 'users'||$params[0] == 'products' && count($params) < 2) {
        $controller->create($params[0]);
    }

} elseif ($method === 'PUT') {

    if ($params[0] == 'users'||$params[0] == 'products' && count($params) == 2) {
        $controller->modify($params[0], $params[1]);
    }

} elseif ($method === 'DELETE') {

    if ($params[0] == 'users'||$params[0] == 'products' && count($params) == 2) {
        $controller->delete($params[0], $params[1]);
    }

} else {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
}