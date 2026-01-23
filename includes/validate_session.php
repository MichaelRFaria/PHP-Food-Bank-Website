<?php

// start session if we haven't
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$timeout = 3600;

// if not logged in, log in

if (!isset($_SESSION["loggedin"])) {
    header("Location: /website/login");
}

// if session is expired, re log in

if (!isset($_SESSION['latest_action_timestamp']) && ((time() - $_SESSION['latest_action_timestamp']) > $timeout)) {
    session_unset();
    session_destroy();

    header("Location: /website/login");
}

// otherwise update timetamp

$_SESSION['latest_action_timestamp'] = time();
?>