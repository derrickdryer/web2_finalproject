<?php
    $isCommunityPage = true;
    $status = session_status();
    if($status == PHP_SESSION_NONE) {
        //There is no active session
        session_start();
        if (!isset($_SESSION['userName'])) {
            header("Location: ../login");
        }
    }

    $communityID = filter_input(INPUT_GET, 'communityID', FILTER_VALIDATE_INT);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('../php/db_connect.php');

    $queryCommunity = "SELECT * FROM COMMUNITY WHERE communityID = :communityID";
    $statement = $db->prepare($queryCommunity);
    $statement->bindValue(':communityID', $communityID);
    $statement->execute();
    $community = $statement->fetch();
    $statement->closeCursor();

    $query2 = "SELECT role FROM USERS_TO_COMMUNITY WHERE userID = (SELECT userID FROM USERS WHERE userName = :userName) AND communityID = :communityID";
    $stmt = $db->prepare($query2);
    $stmt->bindValue(':userName', $_SESSION['userName']);
    $stmt->bindValue(':communityID', $communityID);
    $stmt->execute();
    $role = $stmt->fetchColumn();
    $stmt->closeCursor();

    $query = "SELECT t.threadTitle, t.threadContent, t.threadCreated, u.userName, c.communityName 
                FROM THREADS t, COMMUNITY c, USERS u, USERS_TO_COMMUNITY utc
                WHERE t.communityID = c.communityID
                AND t.userID = u.userID
                AND c.communityID = utc.communityID
                AND utc.userID = u.userID
                AND c.communityID = :communityID
                ORDER BY t.threadCreated DESC;";
    $statement=$db->prepare($query);
    $statement->bindValue(':communityID', $communityID);
    $statement->execute();
    $threads = $statement->fetchAll();
    $statement->closeCursor();

    include('./display.php');
?>