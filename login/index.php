<?php
    // Start session
    $status = session_status();
    if($status == PHP_SESSION_NONE) {
        //There is no active session
        session_start();
    }
    
    // Database connection
    require_once('../php/db_connect.php');

    // Error Reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Login Error
    $error = "";

    // Filter action
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = "";
    }
    if ($action == 'login') {
        $userName = filter_input(INPUT_POST, 'userName');
        $userPassword = filter_input(INPUT_POST, 'userPassword');
        // Query database for hashed password
        $query = 'SELECT userPassword, userID FROM USERS WHERE userName = :userName';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $userName);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        if ($user) {
            // Verify hashed password
            if (password_verify($userPassword, $user['userPassword'])) {
                $_SESSION['userName'] = $userName;
                $_SESSION['userID'] = $user['userID'];
                echo '<p> You are logged in. </p>';
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username.";
        }
    }
    // If user is unset, display login form
    if (!isset($_SESSION['userName'])) {
        include('./login.php');
    } else {
        echo '<p> You are already logged in. </p>';
        header("Location: ../.");
    }
?>