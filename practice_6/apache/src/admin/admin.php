<?php
include './login.php';
include './constants.php';

$dictionary = $DICTIONARY[$_COOKIE['language']];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        span {
            margin: 10px;
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
    <title>Admin</title>


</head>

<body>
<button onclick="window.location.replace(
                `/index.html`)">Main</button>
<button onclick="window.location.replace(
                `/about.html`)">About</button>
<button onclick="window.location.replace(
                `/admin/settings.php`)">Settings</button>
<button onclick="window.location.replace(
                `/catalogue.php`)">Catalogue</button>
<button onclick="window.location.replace(
                `/statistics.php`)">Statistics</button><br>

<div style="display: flex; flex-flow: column nowrap; justify-content: center; align-items: center; border: 2px solid black">
    <h1 style="display: flex; flex-flow: column nowrap; justify-content: center; align-items: center;">
        <?php echo $dictionary->ADMIN_PANEL?>
    </h1>

    <p style="font-size: 18px; font-weight: bold;">
        <?php
        echo $dictionary->HI . " " . ($_COOKIE['name'] ?: $dictionary->NAMELESS) .".";
        ?>
    </p>

    <h2>PDF</h2>
    <form enctype="multipart/form-data" action="./pdf.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
        <div>
            <?php echo $dictionary->SEND_THIS_FILE ?>:
            <label for="uploadbtn" class="uploadButton">
                <?php echo $dictionary->UPLOAD_FILE ?>
            </label>
            <div></div>
            <input style="opacity: 0; z-index: -1;" type="file" name="userfile" id="uploadbtn" onchange='document.querySelector(".uploadButton + div").innerHTML = Array.from(this.files).map(f => f.name).join("<br />")' />
        </div>
        <input type="submit" value="<?php echo $dictionary->SEND_FILE ?>" />
    </form>


    <h3><?php echo $dictionary->UPLOADING_FILES ?></h3>

    <?php
    $files = array_diff(scandir($uploaddir), array('.', '..'));

    echo "<ul>";
    foreach ($files as $file_name) {
        echo "<li><a href=\"./download.php?file={$file_name}\">{$file_name}</a></li>";
    }

    echo "</ul>";
    ?>
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