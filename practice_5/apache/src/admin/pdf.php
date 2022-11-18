<?php
include './login.php';
include './constants.php';

$uploaddir = '/var/www/html/admin/files/';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

echo '<pre>';
setlocale(LC_ALL,'en_US.UTF-8');
$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
if (!str_contains($_FILES['userfile']['tmp_name'], '%PDF-')) {
    echo "Вы пытаетесь загрузить не PDF файл!\n";
}
else {
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
//echo 'Некоторая отладочная информация:';
//print_r($_FILES);
}
echo "</pre>";
?>
<a href="./admin.php">Вернуться обратно</a>
