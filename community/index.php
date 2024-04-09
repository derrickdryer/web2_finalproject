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

    $queryAllCommunities = "SELECT * FROM COMMUNITY";
    $statement = $db->prepare($queryAllCommunities);
    $statement->execute();
    $communities = $statement->fetchAll();
    $statement->closeCursor();

    include('./display.php');
?>