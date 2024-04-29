<?php
    $isAdminPage = true;
    // Check to see if session is already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $action = filter_input(INPUT_GET, 'action');

    // Delete communiy and threads under it
    if($action == 'dc') { // Delete Community
        require_once('../php/db_connect.php');
        $communityID = filter_input(INPUT_GET, 'communityid', FILTER_VALIDATE_INT);
        $query = "DELETE FROM USERS_TO_COMMUNITY WHERE communityID = :communityID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':communityID', $communityID);
        $stmt->execute();
        $stmt->closeCursor();
        
        $query = "DELETE FROM THREADS WHERE communityID = :communityID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':communityID', $communityID);
        $stmt->execute();
        $stmt->closeCursor();

        $query = "DELETE FROM COMMUNITY WHERE communityID = :communityID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':communityID', $communityID);
        $stmt->execute();
        $stmt->closeCursor();
        header('Location: ./index.php');
    }
    if($action == 'du') { // Delete User
        require_once('../php/db_connect.php');
        $userID = filter_input(INPUT_GET, 'userid', FILTER_VALIDATE_INT);
        $query = "DELETE FROM THREADS WHERE userID = :userID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userID', $userID);
        $stmt->execute();
        $stmt->closeCursor();

        $query = "DELETE FROM USERS WHERE userID = :userID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userID', $userID);
        $stmt->execute();
        $stmt->closeCursor();
        header('Location: ./index.php');
    }
    if($action == 'dt') { // Delete Thread
        require_once('../php/db_connect.php');
        // Delete comments first
        $threadID = filter_input(INPUT_GET, 'threadid', FILTER_VALIDATE_INT);
        
        $query = "DELETE FROM THREADS WHERE threadID = :threadID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':threadID', $threadID);
        $stmt->execute();
        $stmt->closeCursor();
        header('Location: ./index.php');
    }

    // Fetch all communities
    require_once('../php/db_connect.php');
    $query = "SELECT * FROM COMMUNITY";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $communities = $stmt->fetchAll();
    $stmt->closeCursor();

    // Fetch all users
    $query = "SELECT * FROM USERS";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll();
    $stmt->closeCursor();

    // Fetch all threads
    $query = "SELECT * FROM THREADS";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $threads = $stmt->fetchAll();
    $stmt->closeCursor();

    include('./dashboard.php');
?>