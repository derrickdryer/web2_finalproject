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

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('../php/db_connect.php');

    $queryCommunity = "SELECT * FROM COMMUNITY WHERE communityID = 2";
    $statement = $db->prepare($queryCommunity);
    $statement->execute();
    $community = $statement->fetch();
    $statement->closeCursor();

    $query = "SELECT t.threadTitle, t.threadContent, t.threadCreated, u.userName, c.communityName 
                FROM THREADS t, COMMUNITY c, USERS u, USERS_TO_COMMUNITY utc
                WHERE t.communityID = c.communityID
                AND t.userID = u.userID
                AND c.communityID = utc.communityID
                AND utc.userID = u.userID
                AND c.communityID = 2
                ORDER BY t.threadCreated DESC;";
    $statement=$db->prepare($query);
    $statement->execute();
    $threads = $statement->fetchAll();
    $statement->closeCursor();

    include('./display.php');
?>