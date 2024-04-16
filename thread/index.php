<?php
    $isNewThreadPage = true;
    // Check to see if session is already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // username from session
    $communities = array();
    if (isset($_SESSION['userName'])) {
        $userName = $_SESSION['userName'];
    } else {
        header('Location: ../login/');
        exit();
    }

    $action = filter_input(INPUT_POST, 'action');

    // Get user's communities
    require_once('../php/db_connect.php');
    $query = "SELECT c.communityID, c.communityName
                FROM COMMUNITY c, USERS_TO_COMMUNITY utc, USERS u
                WHERE u.userID = utc.userID
                AND c.communityID = utc.communityID
                AND u.userName = :userName";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userName', $userName);
    $stmt->execute();
    $communities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    if ($action == 'Submit') {
        
    }

    include('./new-thread.php');
?>