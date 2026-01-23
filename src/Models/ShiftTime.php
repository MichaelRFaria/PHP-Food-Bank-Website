<?php

namespace In3050Inm428WebDev\PhpMvc\Models;

class ShiftTime
{
    public $id;
    public $shift_date;
    public $start_time;
    public $end_time;

    public $category;

    public function __construct($id, $shift_date, $start_time, $end_time, $category)
    {
        $this->id = $id;
        $this->shift_date = $shift_date;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->category = $category;
    }
}