<?php
session_start();
// unset($_SESSION['error']);
require_once('./dbconnect.php');

// // Check if user already logged in.
// if (isset($_SESSION['loggedin'])) {
// 	header('Location: ../index.php');
// 	exit;
// }

// Connect to the database.
$connection = db_connect();

// // double check username and password have been input.
// if (!isset($_POST['email'], $_POST['password']) ) {
// 	$_SESSION['error'] = 'Please enter email and password.';
//     header('Location: ../login.php');
// }

// // clear past mesages (eg. stop the new account message being shown again)
// if(isset($_SESSION['message'])) unset($_SESSION['message']);

// if no errors
if (empty($_SESSION["error"])){
    // Prepare SQL, prepared statements will prevent SQL injection.
    if ($stmt = $connection->prepare('SELECT id, email, password, role FROM users WHERE email = ?')) {
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        // store results
        $stmt->store_result();
        
        // if the user has been found
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $email, $password, $role);
            $stmt->fetch();
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            if (password_verify($_POST['password'], $password)) {
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in.
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $id;
                $_SESSION['role'] = $role;
                $_SESSION['latest_action_timestamp'] = time();


                // Setup login cookie if remember me is checked
                if(isset($_POST['remember']) && !empty($_POST['remember'])) {
                    // Calculate expiration time (48 hours)
                    $current_time = new DateTime();
                    // Generate uid and store in database and cookies
                    $uid = uniqid();
                    if ($stmt = $connection->prepare('INSERT INTO remembered_logins (id, uid, date) VALUES (?, ?, ?)')) {
                        $date_string = $current_time->format('Y-m-d H:i:s');
                        $stmt->bind_param('sss', $id, $uid, $date_string);
                        $stmt->execute();
                        // Set cookies 
                        // expiry must be unix time stamp
                        $cookie_expiration_time = ($current_time->add(new DateInterval('PT8H')))->getTimestamp(); // PT4H original
                        setcookie('userid', $id, $cookie_expiration_time, '/', $_SERVER['SERVER_NAME']);
                        setcookie('userauth', $uid , $cookie_expiration_time, '/', $_SERVER['SERVER_NAME']); 
                        setcookie('remember', TRUE, $cookie_expiration_time, '/', $_SERVER['SERVER_NAME']);
                    }
                }
                else {
                    setcookie('remember', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
                }
                // Redirect to homepage
                header('Location: /website/'); // TEMP
            } 
            else {
                // Incorrect password
                $_SESSION['error'] = 'Incorrect username and/or password!';
                header('Location: /website/login');
            }
        } 
        else {
            // Incorrect username
            $_SESSION['error'] = 'Incorrect username and/or password!';
            header('Location: /website/login');
        }
    }
    // Close connection
    $connection->close();
    
    // // clear remember status if required
    // if(!isset($_POST['remember']) || empty($_POST['remember'])){
    //     setcookie('remember', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
    // }
}
?>