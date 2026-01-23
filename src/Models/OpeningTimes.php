<?php

namespace In3050Inm428WebDev\PhpMvc\Models;

use In3050Inm428WebDev\PhpMvc\Models;

require_once('./includes/dbconnect.php');

class OpeningTimes
{

    public static function getAll()
    {
        // setup sql
        $sql = 'SELECT id, date, open_time, close_time FROM opening_hours ORDER BY id';

        $times = [];
        // get connect and data
        $connection = db_connect();

        // Prepare SQL, prepared statements will help prevent SQL injection.
        if ($stmt = $connection->prepare($sql)) {
            $stmt->execute();
            // output resultset as array of times
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $times[] = new Models\OpeningTime($row['id'], date('l', strtotime($row['date'])), $row['open_time'], $row['close_time']);
            }
        }
        // Close connection
        $connection->close();
        return $times;
    }
}