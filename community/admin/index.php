<?php
    $isCommunityAdmin = true;
    $status = session_status();
    if($status == PHP_SESSION_NONE) {
        //There is no active session
        session_start();
        if (!isset($_SESSION['userName'])) {
            header("Location: ../login");
        }
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $communityID = filter_input(INPUT_GET, 'communityID', FILTER_VALIDATE_INT);
    require_once('../../php/db_connect.php');
    $query = "SELECT JOIN_REQUESTS.*, USERS.userName FROM JOIN_REQUESTS 
          JOIN USERS ON JOIN_REQUESTS.userID = USERS.userID 
          WHERE communityID = :communityID";
    $statement = $db->prepare($query);
    $statement->bindValue(':communityID', $communityID);
    $statement->execute();
    $join_requests = $statement->fetchAll();
    $statement->closeCursor();

    $requestID = filter_input(INPUT_POST, 'requestID', FILTER_VALIDATE_INT);
    $action = filter_input(INPUT_POST, 'action');

    if ($action === 'Accept') {
        // Insert the user into USERS_TO_COMMUNITY
    $query = "INSERT INTO USERS_TO_COMMUNITY (userID, communityID, role, joined) 
    SELECT userID, communityID, 'member', NOW() FROM JOIN_REQUESTS WHERE requestID = :requestID";
    $statement = $db->prepare($query);
    $statement->bindValue(':requestID', $requestID);
    $statement->execute();
    $statement->closeCursor();

    // Delete the request
    $query = "DELETE FROM JOIN_REQUESTS WHERE requestID = :requestID";
    $statement = $db->prepare($query);
    $statement->bindValue(':requestID', $requestID);
    $statement->execute();
    $statement->closeCursor();
    } else if ($action === 'Deny') {
        // Delete the request
        $query = "DELETE FROM JOIN_REQUESTS WHERE requestID = :requestID";
        $statement = $db->prepare($query);
        $statement->bindValue(':requestID', $requestID);
        $statement->execute();
        $statement->closeCursor();
    }

    include('./dashboard.php');
?>