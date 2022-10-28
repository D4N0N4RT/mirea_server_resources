<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <style>
        /* внешние границы таблицы серого цвета толщиной 1px */
        table {
            border: 1px solid grey;
            margin-right: auto;
        }
        /* границы ячеек первого ряда таблицы */
        th {
            border: 1px solid grey;
            font-size: 150%;
        }
        /* границы ячеек тела таблицы */
        td {
            border: 1px solid grey;
            font-size: 150%;
        }
    </style>
</head>
<body>
<button onclick="window.location.replace(
                `/index.html`)">Main</button>
<button onclick="window.location.replace(
                `/about.html`)">About</button>
<button onclick="window.location.replace(
                `/catalogue.php`)">Catalogue</button><br>
<h1>List of users</h1>
<table>
    <tr><th>ID</th><th>Username</th><th>Password</th></tr>
    <?php
    $mysqli = new mysqli('db', 'user', 'password', 'coffeeDB');
    $users = $mysqli->query('SELECT * FROM users');
    foreach ($users as $user) { echo <<<A
            <tr><td>{$user['ID']}</td><td>{$user['username']}</td><td>{$user['password']}</td></tr>
        A; } ?></table>
<?php $mysqli->close(); ?>
</body>
</html>