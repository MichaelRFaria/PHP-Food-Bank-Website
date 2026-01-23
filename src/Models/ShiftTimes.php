<?php

namespace In3050Inm428WebDev\PhpMvc\Models;

use In3050Inm428WebDev\PhpMvc\Models;

require_once('./includes/dbconnect.php');
require_once('./includes/validate_session.php');

class ShiftTimes
{

    public static function getShiftTimes()
    {
        // setup sql
        // BETWEEN = monday of this week and sunday of next week (inclusive)
        $sql = 'SELECT id, shift_date, start_time, end_time, category FROM shifts WHERE shift_date BETWEEN DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) AND DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 13 DAY) ORDER BY shift_date, category';

        $times = [
            'this_week' => [],
            'next_week' => []
        ];

        $current_week = date('W');

        // get connect and data
        $connection = db_connect();

        // Prepare SQL, prepared statements will help prevent SQL injection.
        if ($stmt = $connection->prepare($sql)) {
            $stmt->execute();
            // output resultset as array of times
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $shift_week = (date('W', strtotime($row['shift_date'])) === $current_week) ? "this_week" : "next_week";
                $day = date('l', strtotime($row['shift_date']));

                $times[$shift_week][$day][$row['category']] = new Models\ShiftTime(
                    $row['id'],
                    $day,
                    $row['start_time'] ? date('H:i', strtotime($row['start_time'])) : null,
                    $row['end_time'] ? date('H:i', strtotime($row['end_time'])) : null,
                    $row['category']
                );
            }
        }
        // Close connection
        $connection->close();
        return $times;
    }
}