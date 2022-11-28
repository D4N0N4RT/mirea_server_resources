<?php

include_once "../classes/coffee.php";

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

function read() {
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $coffee = new Coffee(openMysqli());

    $result = $coffee->read();
    $answer = array("answer" => array());

    foreach ($result as $item) {
        $object = array(
            "ID" => $item["ID"],
            "title" => $item["title"],
            "volume" => $item["volume"],
            "price" => $item["price"]
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

    $coffee = new Coffee(openMysqli());

    $data = json_decode(file_get_contents("php://input"));
    if (
        !empty($data->title) &&
        !empty($data->volume) &&
        !empty($data->price)
    ) {
        $coffee->title = $data->title;
        $coffee->volume = $data->volume;
        $coffee->price = $data->price;

        $stmt = $coffee->create();

        if ($stmt) {
            http_response_code(201);
            echo json_encode(array("message" => "Новая позиция добавлена в меню кофейни"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно добавить новую позицию в меню"), JSON_UNESCAPED_UNICODE);
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

    $coffee = new Coffee(openMysqli());

    $data = json_decode(file_get_contents("php://input"));
    if (
        !empty($data->ID) &&
        !empty($data->title) &&
        !empty($data->volume) &&
        !empty($data->price)
    ) {
        $coffee->id = $data->ID;
        $coffee->title = $data->title;
        $coffee->volume = $data->volume;
        $coffee->price = $data->price;

        $stmt = $coffee->update();

        if ($stmt) {
            http_response_code(201);
            echo json_encode(array("message" => "Позиция меню обновлена"), JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Невозможно обновить данные позиции в меню"), JSON_UNESCAPED_UNICODE);
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

    $coffee = new Coffee(openMysqli());

    if (!isset($_GET["id"])) {
        http_response_code(400);
        echo json_encode(array("message" => "Неправильный запрос: не указан ID позиции меню"));
    } else {
        $coffee->id = $_GET["id"];
        $stmt = $coffee->delete();
        if ($stmt) {
            http_response_code(200);
            echo json_encode(array("message" => "Позиция меню удалена"));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Такой позиции меню не существует"));
        }
    }
}