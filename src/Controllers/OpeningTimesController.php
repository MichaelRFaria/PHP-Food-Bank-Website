<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;
use In3050Inm428WebDev\PhpMvc\Models;

class OpeningTimesController extends Controller
{

    public function index()
    {
        $data["pageTitle"] = "Opening Times";
        $data["activePage"] = 'opening-times';

        $times = Models\OpeningTimes::getOpeningTimes();

        $data["this_week"] = $times['this_week'];
        $data["next_week"] = $times['next_week'];

        // render page
        $this->render("openingTimes", $data);
    }
}