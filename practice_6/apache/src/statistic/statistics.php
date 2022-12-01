<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Статистика</title>
</head>
<body>
<?php
require_once "./fixture.php";

generate_data();
?>
<?php
require_once "./bar_graph.php";
require_once "./line_graph.php";
require_once "./pie_graph.php";


function stamp(string $water): GdImage | bool {
    $image = imagecreate(100, 30);
    imagecolorallocatealpha($image, 255, 255, 255, 127);
    $textColor = imagecolorallocatealpha($image, 0, 0, 0, 100);
    imagestring($image, 5, 20, 5, $water, $textColor);
    return $image;
}

function watermark(string $image) {
// Load the stamp and the photo to apply the watermark to
    $im = imagecreatefrompng($image);
    $whitecolor = imagecolorallocate($im, 25, 233, 12);
    $blackcolor = imagecolorallocate($im, 0, 0, 0);
    imagestring($im, 5, 20, 30, 'Copyrights Daniil', $blackcolor);
    header("Content-type: image/png");
    imagepng($im, $image);
}

//watermark(draw_bar_plot(), stamp("Watermark by Daniil"));
//watermark((), stamp("Watermark by Daniil"));
//watermark((), stamp("Watermark by Daniil"));

draw_bar_plot();
draw_line_plot();
draw_pie_plot();

watermark("images/bar_graph.png");
watermark("images/line_graph.png");
watermark("images/pie_graph.png");
?>
<img src="images/bar_graph.png" alt="plot_1.png">
<img src="images/line_graph.png" alt="plot_2.png">
<img src="images/pie_graph.png" alt="plot_3.png">

<table class="table">
    <tr>
        <th>Name</th>
        <th>Color</th>
        <th>Month</th>
        <th>Weekday</th>
        <th>Day of month</th>
    </tr>
    <?php
    $data = get_data();

    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->color."</td>";
        echo "<td>".$data_row->month."</td>";
        echo "<td>".$data_row->weekday."</td>";
        echo "<td>".$data_row->day."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>