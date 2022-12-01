<?php

require_once '/var/www/html/vendor/autoload.php';
require_once 'DataInstance.php';

function generate_data()
{
    $data = array();

    $faker = Faker\Factory::create();
    $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
    $faker->addProvider(new Faker\Provider\ru_RU\Color($faker));
    for ($i = 0; $i < 50; $i++) {
        $data_row = new DataInstance(
            $faker->name(),
            $faker->colorName(),
            $faker->monthName(),
            $faker->dayOfWeek,
            $faker->numberBetween(1,15)
        );
        $data[] = $data_row;
    }
    $jsonData = json_encode($data);
    file_put_contents('fixtures.json', $jsonData);
}


function get_data() {
/*    $loader = new Nelmio\Alice\Loader\NativeLoader();
    $fixtures = $loader->loadFile('./fixtures.yml');*/
    $input = file_get_contents('fixtures.json');
    return json_decode($input);
}

function get_weekday_count(): array {
    $data = get_data();
    $weekday_count = array();
    foreach ($data as $obj) {
        $weekday = $obj->weekday;
        if (!isset($weekday_count[$weekday])) {
            $weekday_count[$weekday] = 0;
        }
        $weekday_count[$weekday] += 1;
    }
    return array("keys" => array_keys($weekday_count), "values" => array_values($weekday_count));
}

function get_month_count(): array {
    $data = get_data();
    $month_count = array();
    foreach ($data as $obj) {
        $month = $obj->month;
        if (!isset($month_count[$month])) {
            $month_count[$month] = 0;
        }
        $month_count[$month] += 1;
    }
    return array("keys" => array_keys($month_count), "values" => array_values($month_count));
}

function get_day_count(): array {
    $data = get_data();
    $day_count = array();
    foreach ($data as $obj) {
        $day = $obj->day;
        if (!isset($day_count[$day])) {
            $day_count[$day] = 0;
        }
        $day_count[$day] += 1;
    }
    return array("keys" => array_keys($day_count), "values" => array_values($day_count));
}