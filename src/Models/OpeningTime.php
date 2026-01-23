<?php

namespace In3050Inm428WebDev\PhpMvc\Models;

class OpeningTime
{
    public $id;
    public $date;
    public $open_time;
    public $close_time;

    public function __construct($id, $date, $open_time, $close_time)
    {
        $this->id = $id;
        $this->date = $date;
        $this->open_time = $open_time;
        $this->close_time = $close_time;
    }
}