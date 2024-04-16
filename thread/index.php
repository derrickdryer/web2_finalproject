<?php
    $isNewThreadPage = true;
    // Check to see if session is already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $error = '';

    // username from session
    $communities = array();
    if (isset($_SESSION['userName'])) {
        $userName = $_SESSION['userName'];
        $userID = $_SESSION['userID'];
    } else {
        header('Location: ../login/');
        exit();
    }

    $action = filter_input(INPUT_POST, 'submit');

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

    if ($action == 'submit') {
        require_once('../php/db_connect.php');
        $threadTitle = filter_input(INPUT_POST, 'title');
        $threadContent = filter_input(INPUT_POST, 'content');
        $communityID = filter_input(INPUT_POST, 'community');
        if ($threadTitle == NULL || $threadContent == NULL || $communityID == NULL ||
            $threadTitle == false || $threadContent == false || $communityID == false || $userID == NULL) {
            $error = 'Content error. Please check all fields and try again.';
        } else {
            try {
                // Assuming $db is your PDO connection
                $sql = "INSERT INTO THREADS (userID, communityID, threadTitle, threadContent, threadCreated)
                    VALUES (:userID, :communityID, :threadTitle, :threadContent, NOW())";
                $stmt = $db->prepare($sql);
        
                // Bind parameters
                $stmt->bindParam(':userID', $userID);
                $stmt->bindParam(':communityID', $communityID);
                $stmt->bindParam(':threadTitle', $threadTitle);
                $stmt->bindParam(':threadContent', $threadContent);
        
                // Execute the statement
                $stmt->execute();
                
                echo "<h2>New record created successfully</h2>";
            } catch(PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        }
    }
    include('./new-thread.php');
?>