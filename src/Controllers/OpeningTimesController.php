<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;
use In3050Inm428WebDev\PhpMvc\Models;

class OpeningTimesController extends Controller
{

    public function index()
    {
        $data["pageTitle"] = "Opening Times";

        $times = Models\OpeningTimes::getAll();

        foreach ($times as $time) {
            $data['opening_times'][] = get_object_vars($time);
        }
        // render page
        $this->render("openingTimes", $data);
    }
}