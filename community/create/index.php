<?php
    session_start();
    if (!isset($_SESSION['userName'])) {
        header('Location: ../../login/');
        exit();
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $error='';
    require_once('../../php/db_connect.php');
    $communityName = filter_input(INPUT_POST, 'communityName');
    $communityDesc = filter_input(INPUT_POST, 'communityDesc');
    if ($communityName == NULL || $communityDesc == NULL ||
        $communityName == false || $communityDesc == false) {
        $error = 'Content error. Please check all fields and try again.';
    } else {
        require_once('../../php/db_connect.php');
        $query = "INSERT INTO COMMUNITY (communityName, communityDesc) VALUES (:communityName, :communityDesc)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':communityName', $communityName);
        $stmt->bindValue(':communityDesc', $communityDesc);
        $stmt->execute();
        $stmt->closeCursor();

        // Insert user as admin
        $query = "SELECT communityID FROM COMMUNITY WHERE communityName = :communityName";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':communityName', $communityName);
        $stmt->execute();
        $communityID = $stmt->fetch()['communityID'];
        $stmt->closeCursor();
        $query = "INSERT INTO USERS_TO_COMMUNITY (userID, communityID, role, joined) VALUES (:userID, :communityID, 'admin', NOW())";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userID', $_SESSION['userID']);
        $stmt->bindValue(':communityID', $communityID);
        $stmt->execute();
        $stmt->closeCursor();        

        header('Location: ../../index.php');
    }
    include('./create-community.php');
?>