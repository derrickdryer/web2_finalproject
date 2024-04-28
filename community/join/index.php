<?php
    $isAllCommunityPage = true;
    $status = session_status();
    if($status == PHP_SESSION_NONE)
    {
        //There is no active session
        session_start();
        if (!isset($_SESSION['userName']))
        {
            header("Location: ../login");
        }
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $error = '';

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = "";
    }

    require_once('../../php/db_connect.php');

    $query = "SELECT * FROM COMMUNITY 
                WHERE communityID 
                NOT IN 
                (SELECT communityID FROM USERS_TO_COMMUNITY WHERE userID = 
                (SELECT userID FROM USERS WHERE userName = :userName))";
    $statement = $db->prepare($query);
    $statement->bindValue(':userName', $_SESSION['userName']);
    $statement->execute();
    $communities = $statement->fetchAll();
    $statement->closeCursor();

    if ($action == 'Join') {
        require_once('../../php/db_connect.php');
        $communityID = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $query = "INSERT INTO USERS_TO_COMMUNITY (userID, communityID, role, joined) 
                    VALUES ((SELECT userID FROM USERS WHERE userName = :userName), :communityID, 'member', NOW())";
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $_SESSION['userName']);
        $statement->bindValue(':communityID', $communityID);
        $statement->execute();
        $statement->closeCursor();
        header("Location: ../../index.php");
    } else if ($action == 'Request to Join') {
        require_once('../../php/db_connect.php');
        $communityID = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $query = "INSERT INTO JOIN_REQUESTS (userID, communityID, requestCreated, status) 
                    VALUES ((SELECT userID FROM USERS WHERE userName = :userName), :communityID, NOW(), 'pending')";
        $statement = $db->prepare($query);
        $statement->bindValue(':userName', $_SESSION['userName']);
        $statement->bindValue(':communityID', $communityID);
        $statement->execute();
        $statement->closeCursor();
        header("Location: ../../index.php");
    }

    include('./communities.php');
?>