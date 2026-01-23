<?php
require_once('dbconnect.php');

if (isset($_SESSION['loggedin'])) {
    return;
}

// Check if cookies are set
if(!empty($_COOKIE['userid']) && !empty($_COOKIE['userauth'])){
    $userid = $_COOKIE['userid'];
    $remembered_uid = $_COOKIE['userauth'];
    $valid_cookie_uid = FALSE;
    // Connect to the database.
    $connection = db_connect();
    if ($stmt = $connection->prepare('SELECT uid, date, email, role FROM remembered_logins rl JOIN users u ON rl.id = u.id WHERE u.id = ?')) {
        $stmt->bind_param('s', $userid);
        $stmt->execute();
        // store results
        $stmt->store_result();
        $stmt->bind_result($uid, $uid_date, $email, $role);

        // if there are rememberd logins for user, iterate and evaluate
        while($stmt->fetch()){
            $uid_date = DateTime::createFromFormat('Y-m-d H:i:s', $uid_date);
            $current_time = new DateTime();
            // validate uid from DB with value in Cookie and expiration (8H)
            // note we're checking the expiration data from the DB not the cookie expiration
            if ($uid == $_COOKIE['userauth'] && $uid_date->add(new DateInterval('PT8H')) >= $current_time){ // "PT4H"

                // valid cookie and uid, setp session data
                // setup session variables
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $userid;
                $_SESSION['role'] = $role;
                $_SESSION['latest_action_timestamp'] = time();
                
                /**** THIS PART IS A CHOICE ***/
                /* Consider if you want to reset the expiration */

                // get string of current datetime for DB
                $date_string = $current_time->format('Y-m-d H:i:s');
                // update uid expiration in DB 
                if ($stmt = $connection->prepare('UPDATE remembered_logins SET date = ? WHERE id = ? AND uid = ?')){
                    $stmt->bind_param('sss', $date_string, $userid, $remembered_uid);
                    $stmt->execute();
                    // update cookie expiration
                    $cookie_expiration_time = ($current_time->add(new DateInterval('PT4H')))->getTimestamp();
                    setcookie("userid", $userid, $cookie_expiration_time, '/', $_SERVER['SERVER_NAME']);
                    setcookie("userauth", $remembered_uid , $cookie_expiration_time, '/', $_SERVER['SERVER_NAME']);
                    setcookie("remember", TRUE, $cookie_expiration_time, '/', $_SERVER['SERVER_NAME']);
                }

                // clear session errors
                unset($_SESSION["error"]);
                $valid_cookie_uid = TRUE;

                // no need to check the rest
                break;
            }
        }
    }
    // Close connection
    $connection->close();

    if (!$valid_cookie_uid) {
        // expire cookies to remove from system
        setcookie('userauth', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
        setcookie('userid', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
        setcookie("remember", '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
    }
}

// get current time to ensure login timeout has not expired
$current_time = time();


