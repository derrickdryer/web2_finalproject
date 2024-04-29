<?php
    require_once('../php/db_connect.php'); // Include this at the top of your file
    $isProfilePage = true;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Fetch user data
    $query = 'SELECT * FROM USERS WHERE userID = :userID';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $_SESSION['userID']);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <h1>Profile</h1>
    <p>Username: <?php echo $user['userName']; ?></p>
    <p>Email: <?php echo $user['userEmail']; ?></p>
</body>
</html>