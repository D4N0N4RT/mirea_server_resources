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
    $blackcolor = imagecolorallocate($im, 0, 0, 0);
    imagestring($im, 5, 20, 30, 'Copyrights Daniil', $blackcolor);
    header("Content-type: image/png");
    imagepng($im, $image);
    //imagecopymerge();
}


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

<table class="table" style="width: 100%; text-align: start">
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Month</th>
        <th>Most favorite week day</th>
        <th>Amount of orders</th>
    </tr>
    <?php
    $data = get_data();

    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->address."</td>";
        echo "<td>".$data_row->month."</td>";
        echo "<td>".$data_row->weekday."</td>";
        echo "<td>".$data_row->orders."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>