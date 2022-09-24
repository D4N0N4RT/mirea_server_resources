<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Quick sort</title>
    </head>
    <body>
        <?php
            include_once 'Sorter.php';
            $a = init($_GET['array'], function($array) {
                echo '[', $array[0];
                for ($i = 1; $i < count($array); $i++) {
                    echo ', ', $array[$i];
                }
                echo ']';
            });
        ?>
    </body>
</html>