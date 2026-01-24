<?php

require_once('./dbconnect.php');
require_once("./validate_session.php");

// if not volunteer
if (!isset($SESSION['loggedin']) || $_SESSION['role'] !== "volunteer") {
	$_SESSION['error'] = 'You must be logged in as a volunteer to book shifts.';
    header('Location: /website/shift-times');
}

$connection = db_connect();

$stmt = $connection->prepare('INSERT INTO shift_registration (shift_id, user_id) VALUES (? , ?)');
$stmt->bind_param('ii', $_POST['shift_id'], $_SESSION['user_id']);

// stmt will only fail if the the user has already booked for this shift
if ($stmt->execute()) {
    $_SESSION['message'] = "Shift booked successfully";
} else {
    $_SESSION['error'] = "You have already booked this shift";
}

$connection->close();

header('Location: /website/shift-times');

?>