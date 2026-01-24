<?php
require_once('./dbconnect.php');
session_start();
unset($_SESSION["error"]);

// // If the user is not logged in redirect to the login page...
// if (isset($_SESSION['loggedin'])) {
// 	header('Location: ../index.php');
// 	exit;
// }

// double check all inputs are set.
if (!isset($_POST['name'],$_POST['phone_number'], $_POST['dob'], $_POST['email'], $_POST['password'], $_POST['confirmation_password'])) {
	$_SESSION["error"] = 'Please enter name, phone number, date of birth, email, password and confirmation password.';
    header('Location: /website/register');
    exit();
}

// checking password matches confirmation password
if ($_POST['password'] != $_POST['confirmation_password']) {
	$_SESSION["error"] = 'Password and confirmation password must match.';
    header('Location: /website/register');
    exit();
}

// checking user is above the age of 18
$dob = new DateTime($_POST['dob']);
$today = new DateTime();
$minimumDob = $today->sub(new DateInterval('P18Y'));

if ($dob > $minimumDob) {
	$_SESSION["error"] = 'Must be older than 18 to make an account.';
    header('Location: /website/register');
    exit();
}

// if no errors
if (empty($_SESSION["error"])) {
    // Connect to the database.
    $connection = db_connect();

    // check email has not been used already

    if ($stmt = $connection->prepare('SELECT COUNT(id) as users FROM users WHERE email = ?')) {
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();
        
        // if the user has been found
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($account_count);
            $stmt->fetch();
            if ($account_count > 0) {
                $_SESSION["error"] = "The provided email address is already in use.";
                    header('Location: /website/register');
                    exit();
            }
        
        }
    }

    // Prepare SQL, prepared statements will prevent SQL injection.
    if ($stmt = $connection->prepare('INSERT INTO users (name, email, phone, password,role,is_over_18) VALUES (?,?,?,?,"volunteer",1)')) {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $_POST['name'],$_POST['email'],$_POST['phone_number'],$hash);
        $stmt->execute();
        $_SESSION["message"] = "Your account has been created.";
        header('Location: /website/login');
        exit();
    }

    // Close connection
    $connection->close();
}

?>