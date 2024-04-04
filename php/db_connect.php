<?php
    # For simplicity, login with root
    $dsn = 'mysql:host=localhost;dbname=threadit';
    $username = 'root';
    $password = '';
    # Try and catch any errors
    try {
        $db = new PDO($dsn, $username, $password);
        if (!isset($_SESSION['db_connection_status']) || $_SESSION['db_connection_status'] != 'success') {
            echo '<div id="success-notification" style="display: none;">You are connected.</div>';
            echo '<script type="text/javascript">
                    var notification = document.getElementById("success-notification");
                    notification.style.display = "block";
                    notification.style.backgroundColor = "green";
                    setTimeout(function() {
                        notification.style.display = "none";
                    }, 2500);
                </script>';
            $_SESSION['db_connection_status'] = 'success';
        }
    }
    catch (PDOException $e){
        $error_message = $e->getMessage();
        if (!isset($_SESSION['db_connection_status']) || $_SESSION['db_connection_status'] != 'failed') {
            echo '<link rel="stylesheet" type="text/css" href="./css/main.css">';
            echo '<div id="error-notification" style="display: none;">Connection failed due to error: ' . $error_message . '</div>';
            echo '<script type="text/javascript">
                    var notification = document.getElementById("error-notification");
                    notification.style.display = "block";
                    notification.style.backgroundColor = "red";
                    setTimeout(function() {
                        notification.style.display = "none";
                    }, 2500);
                </script>';
            $_SESSION['db_connection_status'] = 'failed';
        }
    }
?>