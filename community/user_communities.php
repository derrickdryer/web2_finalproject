<?php
    $isMyCommunityPage = true;
    $status = session_status();
    if($status == PHP_SESSION_NONE) {
        //There is no active session
        session_start();
        if (!isset($_SESSION['userName'])) {
            header("Location: ../login");
        }
    }
    require_once('../php/db_connect.php');
    $query = "SELECT * FROM COMMUNITY WHERE communityID IN (SELECT communityID FROM USERS_TO_COMMUNITY WHERE userID = (SELECT userID FROM USERS WHERE userName = :userName))";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userName', $_SESSION['userName']);
    $stmt->execute();
    $user_communities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Communities</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <ul>
        <?php foreach($user_communities as $community) : ?>
            <li>
                <h3><?php echo $community['communityName']; ?></h3>
                <p><?php echo $community['communityDesc']; ?></p>
                <a href="http://localhost/web2_finalproject/community/index.php?communityID=<?php echo $community['communityID']; ?>">View Community</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>