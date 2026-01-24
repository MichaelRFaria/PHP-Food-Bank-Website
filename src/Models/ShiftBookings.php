<?php

namespace In3050Inm428WebDev\PhpMvc\Models;

use In3050Inm428WebDev\PhpMvc\Models;

require_once('./includes/dbconnect.php');
require_once('./includes/validate_session.php');

class ShiftBookings
{

    public static function getShiftBookings()
    {
        // setup sql
        // BETWEEN = monday of this week and sunday of next week (inclusive)
        $sql = 'SELECT sr.id, s.shift_date, s.category, u.name, u.email FROM shift_registration sr JOIN shifts s on sr.shift_id = s.id JOIN users u on sr.user_id = u.id WHERE s.shift_date BETWEEN DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) AND DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 13 DAY) ORDER BY s.shift_date, s.category';

        $bookings = [
            'this_week' => [],
            'next_week' => []
        ];

        $current_week = date('W');

        // get connect and data
        $connection = db_connect();

        // Prepare SQL, prepared statements will help prevent SQL injection.
        if ($stmt = $connection->prepare($sql)) {
            $stmt->execute();
            // output resultset as array of bookings
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $shift_week = (date('W', strtotime($row['shift_date'])) === $current_week) ? "this_week" : "next_week";
                $day = date('l', strtotime($row['shift_date']));

                $bookings[$shift_week][$day][$row['category']][] = [
                    'name' => $row['name'],
                    'email' => $row['email']
                ];
            }
        }
        // Close connection
        $connection->close();
        return $bookings;
    }
}