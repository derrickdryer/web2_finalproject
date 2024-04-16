<?php
    // Start session
    $status = session_status();
    if($status == PHP_SESSION_NONE) {
        //There is no active session
        session_start();
    }
    $error = array();

    // Database connection
    require_once('../php/db_connect.php');

    $register = filter_input(INPUT_GET, 'action');
    if (!isset($register)) {
        $email = filter_input(INPUT_GET, 'userEmail', FILTER_VALIDATE_EMAIL);
        $name = filter_input(INPUT_GET, 'userName');
        $password = filter_input(INPUT_GET, 'userPassword');
        $password2 = filter_input(INPUT_GET, 'userPassword2');
    }
    if (empty($email)) {
        $error['email'] = 'Please enter a valid email address.';
    }
    if (empty($name)) {
        $error['name'] = 'Please enter a valid username.';
    } else {
        $query = 'SELECT * FROM users WHERE username = :name';
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        if ($user) {
            $error['name'] = 'Username already exists.';
        }
    }

    if (empty($password != $password2)) {
        $error['password'] = 'Passwords do not match.';
    }

    if (empty($error)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO users (email, username, password) VALUES (:email, :name, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':password', $hashedPassword);
        if ($statement->execute()) {
            $_SESSION['user'] = $name;
            header('Location: ../login/');
            exit();
        } else {
            $error['register'] = 'Registration failed.';
        }
    }

    include('./register.php');
?>