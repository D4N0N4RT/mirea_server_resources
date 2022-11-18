<?php

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');

    exit;
}
$mysqli = new mysqli('db', 'user', 'password', 'coffeeDB');
$stmt = $mysqli->prepare("SELECT `password` FROM users WHERE `username`=?;");
$res = $stmt->bind_param('s', $_SERVER['PHP_AUTH_USER']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_array(MYSQLI_ASSOC);

// получение данных для сессии пользователя
session_start();

$redis = new Redis();
try {
    $redis->connect('redis', 6379);
} catch (RedisException $e) {
}

$redis_data = json_decode($redis->get($_SERVER['PHP_AUTH_USER']));

if (!$redis_data) {
    $default_data = [
        "language" => 'ru',
        "theme" => 'light',
        'name' => 'admin',
    ];

    $default_data_redis = json_encode($default_data);

    $redis->set($_SERVER['PHP_AUTH_USER'], $default_data_redis);

    $redis_data = json_decode($default_data_redis);
}

setcookie("language", $redis_data->language);
setcookie("theme", $redis_data->theme);
setcookie("name", $redis_data->name);
?>