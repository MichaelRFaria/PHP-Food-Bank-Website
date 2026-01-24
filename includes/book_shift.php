<?php

session_start();

require_once('./dbconnect.php');
require_once("./validate_session.php");

// if not volunteer
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "volunteer") {
	$_SESSION['error'] = 'You must be logged in as a volunteer to book shifts.';
    header('Location: /website/shift-times');
    exit();
}

$connection = db_connect();

// check if user has already volunteered for this shift
$stmt = $connection->prepare('SELECT * FROM shift_registration WHERE shift_id = ? AND user_id = ?');
$stmt->bind_param('ii', $_POST['shift_id'], $_SESSION['user_id']);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows() > 0) {
	$_SESSION['error'] = 'You have already booked this shift.';
    header('Location: /website/shift-times');
    exit();
}

// check if user has already volunteered for two shifts for this day
$stmt = $connection->prepare('SELECT * FROM shift_registration sr JOIN shifts s1 ON sr.shift_id = s1.id JOIN shifts s2 ON s2.id = ? WHERE user_id = ? AND s1.shift_date = s2.shift_date');
$stmt->bind_param('ii', $_POST['shift_id'], $_SESSION['user_id']);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows() >= 2) {
	$_SESSION['error'] = 'You have already booked for the maximum number of shifts for this day.';
    header('Location: /website/shift-times');
    exit();
}

// check if shift has max bookings
$stmt = $connection->prepare('SELECT * FROM shift_registration WHERE shift_id = ?');
$stmt->bind_param('i', $_POST['shift_id']);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows() >= 2) {
	$_SESSION['error'] = 'Maximum number of volunteers for this shift reached.';
    header('Location: /website/shift-times');
    exit();
}

$stmt = $connection->prepare('INSERT INTO shift_registration (shift_id, user_id) VALUES (? , ?)');
$stmt->bind_param('ii', $_POST['shift_id'], $_SESSION['user_id']);

if ($stmt->execute()) {
    $_SESSION['message'] = "Shift booked successfully";
} else {
    $_SESSION['error'] = "Shift booking failed";
}

$connection->close();

header('Location: /website/shift-times');
exit();
?>