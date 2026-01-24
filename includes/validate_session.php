<?php

// start session if we haven't
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$timeout = ($_SESSION["role"] == "staff") ? 28800 : 3600;

// if not logged in, log in
if (!isset($_SESSION["loggedin"])) {
    $_SESSION["error"] = "Please log in to access this content.";
    header("Location: /website/login");
    exit();
}

// if session is expired, re log in
if (!isset($_SESSION['latest_action_timestamp']) && ((time() - $_SESSION['latest_action_timestamp']) > $timeout)) {
    session_unset();
    session_destroy();

    $_SESSION['error'] = 'Session expired, please log in again.';
    header("Location: /website/login");
    exit();
}

// otherwise update timetamp

$_SESSION['latest_action_timestamp'] = time();
?>