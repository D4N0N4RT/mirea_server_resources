<?php

class DataInstance
{
    public string $name;
    public string $address;
    public string $month;
    public string $weekday;
    public int $orders;

    /**
     * @param string $name
     * @param string $address
     * @param string $month
     * @param string $weekday
     * @param int $orders
     */
    public function __construct(string $name, string $address, string $month, string $weekday, int $orders)
    {
        $this->name = $name;
        $this->address = $address;
        $this->month = $month;
        $this->weekday = $weekday;
        $this->orders = $orders;
    }


}