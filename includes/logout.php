<?php
require_once('dbconnect.php');

session_start();

// removing cookies from db
if (!empty($_COOKIE['userid']) && !empty($_COOKIE['userauth'])) {
    $userid = $_COOKIE['userid'];
    $remembered_uid = $_COOKIE['userauth'];

    $connection = db_connect();

    $stmt = $connection->prepare('DELETE FROM remembered_logins WHERE id = ? AND uid = ?');
    $stmt->bind_param('ss', $userid, $remembered_uid);
    $stmt->execute();

    $connection->close();
}

// expire cookies to remove from system
setcookie('userauth', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
setcookie('userid', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
setcookie("remember", '', time() - 3600, '/', $_SERVER['SERVER_NAME']);

// clear session
session_unset();
session_destroy();
// Redirect to the index page:
header('Location: /website/');
?>