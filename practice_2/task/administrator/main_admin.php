<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Administration</title>
    </head>
    <body>
        <form method="POST">
        <label for="task3">Введите команду</label>
        <input
            id="task3"
            type="text"
            name="input"/>
        <input type="submit" value="Выполнить">
        </form>
        
        <?php
            $command = " ";
            if(isset($_POST["input"])){
                $command = $_POST["input"];
            }
            include_once 'Admin.php';
            command($command);
        ?>
    </body>
</html>