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
        $bookings = Models\ShiftBookings::getShiftBookings();

        $data["shifts_this_week"] = $times['this_week'];
        $data["shifts_next_week"] = $times['next_week'];
        $data["bookings_this_week"] = $bookings['this_week'];
        $data["bookings_next_week"] = $bookings['next_week'];

        $data['role'] = $_SESSION['role'] ?? null;

        // render page
        $this->render("shiftTimes", $data);
    }
}