<?php
require_once('./dbconnect.php');

$connection = db_connect();

$stmt = $connection->prepare('UPDATE opening_hours SET open_time = ?, close_time = ? WHERE id = ?');
$stmt->bind_param('ssi', $_POST['open_time'], $_POST['close_time'], $_POST['id']);
$stmt->execute();

$connection->close();

header('Location: /website/opening-times');
?>