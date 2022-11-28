<?php
include './login.php';
include './constants.php';

$dictionary = $DICTIONARY[$_SESSION['language']];
?>

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
        <?php
        if ($_COOKIE['theme'] == THEME::$DARK) {
            echo '* {
                color: rgb(233, 233, 233);
                background-color: rgb(47, 45, 45);
            }';
        }
        ?>
    </style>
</head>
<body>

<button onclick="window.location.replace(
                `/index.html`)">Main</button>
<button onclick="window.location.replace(
                `/about.html`)">About</button>
<button onclick="window.location.replace(
                `/admin/admin.php`)">Administrate</button>
<button onclick="window.location.replace(
                `/catalogue.php`)">Catalogue</button><br>

<h2><?php echo $dictionary->SETTING ?></h2>

<form action="./setting.php" method="post"  style=" display: flex; flex-flow: column nowrap; justify-content: center;">
    <div>
        <?php echo $dictionary->THEME ?>: <br>
        <label>
            <input type="radio" name="theme" <?php
            if ($_COOKIE['theme'] == THEME::$LIGHT) {
                echo "checked";
            }
            ?> value="light">
            <?php echo $dictionary->LIGHT ?>
        </label>
        <label>
            <input type="radio" name="theme" <?php
            if ($_COOKIE['theme'] == THEME::$DARK) {
                echo "checked";
            }
            ?> value="dark">
            <?php echo $dictionary->DARK ?>
        </label>
    </div>

    <div>
        <?php echo $dictionary->LANGUAGE ?>: <br>
        <label>
            <input type="radio" name="language" <?php
            if ($_COOKIE['language'] == LANGUAGE::$RU) {
                echo "checked";
            }
            ?> value="ru">
            Русский
        </label>
        <label>
            <input type="radio" name="language" <?php
            if ($_COOKIE['language'] == LANGUAGE::$EN) {
                echo "checked";
            }
            ?> value="en">
            English
        </label>
    </div>

    <div>
        <label>
            <?php echo $dictionary->NAME ?>:
            <input type="text" name="name" value="<?php echo $_COOKIE['name'] ?>">
        </label>
    </div>

    <button type="submit"><?php echo $dictionary->UPDATE ?></button>
</form>
</body>
</html>
