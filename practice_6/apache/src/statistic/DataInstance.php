<?php

class DataInstance
{
    public string $name;
    public string $color;
    public string $month;
    public string $weekday;

    /**
     * @param string $name
     * @param string $color
     * @param string $month
     * @param string $weekday
     */
    public function __construct(string $name, string $color, string $month, string $weekday)
    {
        $this->name = $name;
        $this->color = $color;
        $this->month = $month;
        $this->weekday = $weekday;
    }


}