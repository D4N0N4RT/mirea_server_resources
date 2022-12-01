<?php
/*
require_once '/var/www/html/jpgraph/jpgraph.php';
require_once '/var/www/html/jpgraph/jpgraph_line.php';*/
require_once 'fixture.php';
require_once '/var/www/html/vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

function draw_line_plot() : void
{

    $graph_data = get_day_count();
    $ydata = $graph_data["values"];
    $xdata = $graph_data["keys"];

    sort($xdata);

    $graph = new Graph\Graph(650, 450, 'lineGraph', 10, true);

    $graph->SetScale('textlin');


    $lineplot = new Plot\LinePlot($ydata, $xdata);

    $lineplot->SetColor('forestgreen');

    $graph->Add($lineplot);

    $graph->title->Set('Birthday day of month graph');

    $graph->title->SetFont(FF_ARIAL, FS_NORMAL);
    $graph->xaxis->title->SetFont(FF_VERDANA, FS_ITALIC);
    $graph->yaxis->title->SetFont(FF_TIMES, FS_BOLD);

    $graph->xaxis->title->Set('Day of month');
    $graph->yaxis->title->Set('Birthdays amount');

    $graph->xaxis->SetColor('#СС0000');
    $graph->yaxis->SetColor('#СС0000');

    $lineplot->SetWeight(1);

    $lineplot->value->Show();

    $graph->SetShadow(2);

    $graph->title->Set("Birthday day of month graph");

    $graph->title->SetFont(FF_FONT1, FS_BOLD);

    $graph->Stroke('images/line_graph.png');

    //return $graph->Stroke('/var/www/html/statistic/images/line_graph.png');
}