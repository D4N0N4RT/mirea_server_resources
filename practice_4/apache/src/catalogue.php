<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coffee Catalogue</title>
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
                `/admin.php`)">Administrate</button><br>
<h1>Catalogue</h1>
<table>
    <tr><th>Title</th><th>Volume (L)</th><th>Price (Rub)</th></tr>
    <?php
    $mysqli = new mysqli('db', 'user', 'password', 'coffeeDB',3306);
    $result = $mysqli->query("SELECT * FROM products");
    if ($result->num_rows > 0) foreach ($result as $valuable) echo <<<A
            <tr><td>{$valuable["title"]}</td><td>{$valuable["volume"]}</td><td>{$valuable["price"]}</td></tr>
     A; else echo 'Empty'; ?>
</table>
<?php $mysqli->close(); ?>
</body>
</html>