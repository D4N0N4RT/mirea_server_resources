<?php
/*
require_once '/var/www/html/jpgraph/jpgraph.php';
require_once '/var/www/html/jpgraph/jpgraph_pie.php';*/
require_once 'fixture.php';
require_once '/var/www/html/vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;


function draw_pie_plot() : GdImage
{
    $graph_data = get_weekday_count();
    $data = $graph_data["values"];
    $labels = $graph_data["keys"];

    $graph = new Graph\PieGraph(600, 400, 'pieGraph', 10, true);

    $pieplot = new Plot\PiePlot($data);

    $pieplot->SetColor('');

    $pieplot->ShowBorder();
    $pieplot->SetColor('black');

    $pieplot->SetLabels($labels);

    $graph->title->Set('Круговая диаграмма');

    $graph->Add($pieplot);

    $graph->SetShadow(4);

    return $graph->Stroke('/var/www/html/statistic/images/pie_graph.png');
}
