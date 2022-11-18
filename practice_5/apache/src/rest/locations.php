<?php

include_once "../classes/location.php";

function openMysqli(): mysqli
{ return new mysqli('db', 'user', 'password', 'coffeeDB'); }

define('requestMethod', $_SERVER['REQUEST_METHOD']);

switch (requestMethod) {
    case 'GET': read(); break;
    case 'POST': create(); break;
    case 'PUT': update(); break;
    case 'DELETE': delete(); break;
    default: echo "Error"; break;
}

function read()
{
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $location = new Location(openMysqli());

    $result = $location->read();
    $answer = array("answer" => array());

    foreach ($result as $item) {
        $object = array(
            "ID" => $item["ID"],
            "address" => $item["address"]
        );
        $answer["answer"][] = $object;
    }

    http_response_code(200);
    echo json_encode($answer);
}

function create() {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Method: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $location = new Location(openMysqli());

    $data = json_decode(file_get_contents("php://input"));
    if (
        !empty($data->address)
    ) {
        $location->address = $data->address;

        $stmt = $location->create();

        if ($stmt) {
            http_response_code(201);
            echo json_encode(array("message" => "Новая кофейня добавлена в список кофеен"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно добавить новую кофейню"), JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Ошибка ввода: данные неполные"), JSON_UNESCAPED_UNICODE);
    }
}

function update() {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Method: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $location = new Location(openMysqli());

    $data = json_decode(file_get_contents("php://input"));
    if (
        !empty($data->ID) &&
        !empty($data->address)
    ) {
        $location->id = $data->ID;
        $location->address = $data->address;

        $stmt = $location->update();

        if ($stmt) {
            http_response_code(201);
            echo json_encode(array("message" => "Данные кофейни обновлены"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно обновить данные кофейни"), JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Ошибка ввода: данные неполные"), JSON_UNESCAPED_UNICODE);
    }
}

function delete() {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    $location = new Location(openMysqli());

    if (!isset($_GET["id"])) {
        http_response_code(400);
        echo json_encode(array("message" => "Неправильный запрос: не указан ID кофейни"));
    } else {
        $location->id = $_GET["id"];
        $stmt = $location->delete();
        if ($stmt) {
            http_response_code(200);
            echo json_encode(array("message" => "Данные кофейни удалены"));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Такой кофейни не существует"));
        }
    }
}