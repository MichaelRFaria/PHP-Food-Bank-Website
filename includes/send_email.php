<?php

session_start();

// double check all inputs are set.
if (!isset($_POST['name'],$_POST['email'], $_POST['message'])) {
	$_SESSION["error"] = 'Please enter name, email,and message.';
    header('Location: /website/contact_us');
    exit();
} else {
    $_SESSION['message'] = 'Message successfully sent, content: ' . htmlspecialchars(trim($_POST['message']));
    header('Location: /website/contact_us');
    exit();
}

?>