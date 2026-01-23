<?php

namespace In3050Inm428WebDev\PhpMvc\Models;

use In3050Inm428WebDev\PhpMvc\Models;

require_once('./includes/dbconnect.php');

class OpeningTimes
{

    public static function getOpeningTimes()
    {
        // setup sql
        // BETWEEN = monday of this week and sunday of next week (inclusive)
        $sql = 'SELECT id, date, open_time, close_time FROM opening_hours WHERE date BETWEEN DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) AND DATE_ADD(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), INTERVAL 13 DAY) ORDER BY date';

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
                $day = [
                    'id' => $row['id'],
                    'date' => date('l', strtotime($row['date'])),
                    'open_time' => $row['open_time'],
                    'close_time' => $row['close_time']
                ];

                if (date('W', strtotime($row['date'])) === $current_week) {
                    $times['this_week'][] = $day;
                } else {
                    $times['next_week'][] = $day;
                }
            }
        }
        // Close connection
        $connection->close();
        return $times;
    }
}