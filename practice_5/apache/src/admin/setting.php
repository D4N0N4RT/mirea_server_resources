<?php

    include 'login.php';

    $data_redis = json_encode([
        "language" => $_POST['language'],
        "theme" => $_POST['theme'],
        "name" => $_POST['name'],
    ]);

    $redis->set($_SERVER['PHP_AUTH_USER'], $data_redis);

    $_SESSION['language'] = $_POST['language'];
    $_SESSION['theme'] = $_POST['theme'];
    $_SESSION['name'] = $_POST['name'];

    setcookie("language", $_POST['language']);
    setcookie("theme", $_POST['theme']);
    setcookie("name", $_POST['name']);

    header('Location: ./settings.php');
?>