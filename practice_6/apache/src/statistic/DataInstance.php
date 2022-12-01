<?php

class DataInstance
{
    public string $name;
    public string $color;
    public string $month;
    public string $weekday;
    public int $day;

    /**
     * @param string $name
     * @param string $color
     * @param string $month
     * @param string $weekday
     * @param int $day
     */
    public function __construct(string $name, string $color, string $month, string $weekday, int $day)
    {
        $this->name = $name;
        $this->color = $color;
        $this->month = $month;
        $this->weekday = $weekday;
        $this->day = $day;
    }


}