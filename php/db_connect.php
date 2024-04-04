<?php
    # For simplicity, login with root
    $dsn = 'mysql:host=localhost;dbname=threadit';
    $username = 'root';
    $password = '';

    # Try and catch any errors
    try {
        $db = new PDO($dsn, $username, $password);
        echo '<center><p> You are connected. </p></center>';
    }
    catch (PDOException $e){
        $error_message = $e->getMessage();
        echo '<center><p> Connection failed due to error : $error_message </p></center>';
    }
?>