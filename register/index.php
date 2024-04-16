<?php
    // Start session
    $status = session_status();
    if($status == PHP_SESSION_NONE) {
        //There is no active session
        session_start();
    }

    require_once('../php/db_connect.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $error = "";

    $action = filter_input(INPUT_POST, 'register');
    if ($action == NULL) {
        $action = "";
    }
    if ($action == 'register') {
        $userEmail = filter_input(INPUT_POST, 'userEmail');
        $userName = filter_input(INPUT_POST, 'userName');
        $userPassword = filter_input(INPUT_POST, 'userPassword');
        $userPassword2 = filter_input(INPUT_POST, 'userPassword2');
        if ($userPassword != $userPassword2) {
            $error = "Passwords do not match.";
        }
        $query = 'SELECT userName FROM USERS WHERE userName = :userName';
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $userName);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $error = "Username already exists.";
        }
        $statement->closeCursor();
        if ($error == "") {
            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            $query = 'INSERT INTO USERS (userName, userPassword, userEmail) VALUES (:userName, :userPassword, :userEmail)';
            $statement = $db->prepare($query);
            $statement->bindValue(':userName', $userName);
            $statement->bindValue(':userPassword', $hashedPassword);
            $statement->bindValue(':userEmail', $userEmail);
            $statement->execute();
            $statement->closeCursor();
            $_SESSION['userName'] = $userName;
            header("Location: ../.");
        }

    }

    include('./register.php');
?>