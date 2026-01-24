<?php

require_once('./dbconnect.php');
require_once("./validate_session.php");

// if not volunteer
if (!isset($SESSION['loggedin']) || $_SESSION['role'] !== "staff") {
	$_SESSION['error'] = 'You must be logged in as a staff to update opening hours.';
    header('Location: /website/opening-times');
}

$connection = db_connect();

$stmt = $connection->prepare('UPDATE opening_hours SET open_time = ?, close_time = ? WHERE id = ?');
$stmt->bind_param('ssi', $_POST['open_time'], $_POST['close_time'], $_POST['id']);
$stmt->execute();

$connection->close();

header('Location: /website/opening-times');
?>