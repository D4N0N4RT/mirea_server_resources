<?php

/*require_once '/var/www/html/jpgraph/jpgraph.php';
require_once '/var/www/html/jpgraph/jpgraph_bar.php';*/
require_once 'fixture.php';
require_once '/var/www/html/vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

function draw_bar_plot(): void
{
    $graph_data = get_month_count();
    $data = $graph_data["values"];
    $labels = $graph_data["keys"];

    $graph = new Graph\Graph(650, 400, 'barGraph', 10, true);

    $graph->SetScale('textlin');

    $barplot = new Plot\BarPlot($data);

    $graph->title->Set('Birthday month graph');

    $graph->SetScale('textlin');

    $graph->xaxis->SetTickLabels($labels);

    $graph->title->Set("Birthday month graph");

    $graph->title->SetFont(FF_FONT1, FS_BOLD);

    $graph->Add($barplot);

    $graph->Stroke('images/bar_graph.png');

    //return $graph->Stroke('/var/www/html/statistic/images/bar_graph.png');
}
