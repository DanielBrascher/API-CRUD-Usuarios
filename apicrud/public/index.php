<?php 
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../src/controller/UserController.php";

$controller = new UserController();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace("/apicrud/public", "", $uri); 
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' && $uri === '/users') {
    $controller->createUser();
}

elseif ($method === 'GET' && preg_match("#^/users/(\d+)$#", $uri, $matches)) {
    $controller->getUser($matches[1]);
}

elseif ($method === 'GET' && $uri === '/users') {
    $controller->listUsers();
}

elseif ($method === 'PUT' && preg_match("#^/users/(\d+)$#", $uri, $matches)) {
    $controller->updateUser($matches[1]);
}

elseif ($method === 'DELETE' && preg_match("#^/users/(\d+)$#", $uri, $matches)) {
    $controller->deleteUser($matches[1]);
}

else {
    http_response_code(404);
    echo json_encode(["error" => "Rota nao encontrada"]);
}

?>