<?php

session_start();

require_once('./dbconnect.php');
require_once("./validate_session.php");

// if not volunteer
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== "staff") {
	$_SESSION['error'] = 'You must be logged in as staff to update opening hours.';
    header('Location: /website/opening-times');
    exit();
}

$connection = db_connect();

if ($_POST['open_time'] > $_POST['close_time']) {
    $_SESSION['error'] = 'Opening time cannot be after the closing time.';
    header('Location: /website/opening-times');
    exit();
}

$stmt = $connection->prepare('UPDATE opening_hours SET open_time = ?, close_time = ? WHERE id = ?');
$stmt->bind_param('ssi', $_POST['open_time'], $_POST['close_time'], $_POST['id']);

if ( $stmt->execute() ) {
    $_SESSION['message'] = 'Successfully updated opening times.';
} else {
    $_SESSION['error'] = 'Unsuccessful updating of opening times.';
}

$connection->close();

header('Location: /website/opening-times');
?>