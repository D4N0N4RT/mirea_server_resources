<?php
/*
require_once '/var/www/html/jpgraph/jpgraph.php';
require_once '/var/www/html/jpgraph/jpgraph_line.php';*/
require_once 'fixture.php';
require_once '/var/www/html/vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

function draw_line_plot() : GdImage
{

    $graph_data = get_day_count();
    $ydata = $graph_data["values"];
    $xdata = $graph_data["keys"];

    $graph = new Graph\Graph(600, 400, 'lineGraph', 10, true);

// Указываем, какие оси использовать:
    $graph->SetScale('textlin');


    $lineplot = new Plot\LinePlot($ydata, $xdata);

    $lineplot->SetColor('forestgreen');

    $graph->Add($lineplot);

    $graph->title->Set('Линейный график');

    $graph->title->SetFont(FF_ARIAL, FS_NORMAL);
    $graph->xaxis->title->SetFont(FF_VERDANA, FS_ITALIC);
    $graph->yaxis->title->SetFont(FF_TIMES, FS_BOLD);

    $graph->xaxis->title->Set('Ось x');
    $graph->yaxis->title->Set('Ось y');

    $graph->xaxis->SetColor('#СС0000');
    $graph->yaxis->SetColor('#СС0000');

    $lineplot->SetWeight(2);

    $lineplot->value->Show();

    $graph->SetShadow(4);

    return $graph->Stroke('/var/www/html/statistic/images/line_graph.png');
}