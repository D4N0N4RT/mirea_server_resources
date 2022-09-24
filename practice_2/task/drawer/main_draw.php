<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Drawer</title>
    </head>
    <body>
        <?php
            include_once 'Drawer.php';
            $parameter = $_GET['encoded'];

            if ($parameter > 0b11111111 || $parameter < 0)
                echo 'Параметром должно быть целое число от 0 до 255';
            else new Drawer($parameter);
        ?>
    </body>
</html>