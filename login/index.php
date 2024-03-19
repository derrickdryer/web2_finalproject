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
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = "";
    }
    if ($action == 'login') {
        $userName = filter_input(INPUT_GET, 'userName');
        $userPassword = filter_input(INPUT_GET, 'userPassword');
        $query = 'SELECT * FROM USERS WHERE userName = :userName AND userPassword = :userPassword';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $userName);
        $statement->bindValue(':userPassword', $userPassword);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        if ($user) {
            $_SESSION['userName'] = $userName;
            //header("Location: ../index.php");
            echo '<p> You are logged in. </p>';
        } else {
            $error = "Invalid username or password.";
        }
    }

    include('./login.php');
?>