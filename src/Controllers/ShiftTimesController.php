<?php

namespace In3050Inm428WebDev\PhpMvc\Controllers;

use In3050Inm428WebDev\PhpMvc\Controller;
use In3050Inm428WebDev\PhpMvc\Models;

class ShiftTimesController extends Controller
{

    public function index()
    {
        $data["pageTitle"] = "Volunteer Shift Times";
        $data["activePage"] = 'shift-times';

        $times = Models\ShiftTimes::getShiftTimes();

        $data["this_week"] = $times['this_week'];
        $data["next_week"] = $times['next_week'];

        $data['role'] = $_SESSION['role'] ?? null;

        // render page
        $this->render("shiftTimes", $data);
    }
}