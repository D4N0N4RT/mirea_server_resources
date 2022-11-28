<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Статистика</title>
</head>
<body>
<?php
require_once "statistic/fixture.php";

generate_data();
?>
<?php
require_once "./statistic/bar_graph.php";
require_once "./statistic/line_graph.php";
require_once "./statistic/pie_graph.php";


function stamp(string $water): GdImage | bool {
    $image = imagecreate(100, 30);
    imagecolorallocatealpha($image, 255, 255, 255, 127);
    $textColor = imagecolorallocatealpha($image, 0, 0, 0, 100);
    imagestring($image, 5, 20, 5, $water, $textColor);
    return $image;
}

function watermark(GdImage $image, GdImage $stamp) {
    $stampWidth = imagesx($stamp);
    $stampHeight = imagesy($stamp);
    imagecopy(
        $image, $stamp,
        imagesx($image) - $stampWidth - 250,
        imagesy($image) - $stampHeight - 200,
        0, 0,
        $stampWidth, $stampHeight
    );
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}

//watermark(draw_bar_plot(), stamp("Watermark by Daniil"));
//watermark(draw_line_plot(), stamp("Watermark by Daniil"));
//watermark(draw_pie_plot(), stamp("Watermark by Daniil"));

?>
<img src="./statistic/images/bar_graph.png" alt="plot_1.png">
<img src="./statistic/images/line_graph.png" alt="plot_2.png">
<img src="./statistic/images/pie_graph.png" alt="plot_3.png">

<table class="table">
    <tr>
        <th>Name</th>
        <th>Color</th>
        <th>Month</th>
        <th>Weekday</th>
    </tr>
    <?php
    $data = get_data();

    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->color."</td>";
        echo "<td>".$data_row->month."</td>";
        echo "<td>".$data_row->weekday."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>