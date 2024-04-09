<?php
    $isHomePage = true;
    // Check to see if session is already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //$_SESSION['userName'] = 'test'; // Test purposes only
    // Clear session, test purposes only
    //session_unset();

    // Query all public threads
    require_once('./php/db_connect.php');
    $query = "SELECT t.threadTitle, t.threadContent, t.threadCreated, u.userName, c.communityName 
                FROM THREADS t, COMMUNITY c, USERS u, USERS_TO_COMMUNITY utc
                WHERE t.communityID = c.communityID
                AND t.userID = u.userID
                AND c.communityID = utc.communityID
                AND utc.userID = u.userID
                AND c.communityPrivacy = 0
                ORDER BY t.threadCreated DESC;";
    $statement=$db->prepare($query);
    $statement->execute();
    $threads = $statement->fetchAll();
    $statement->closeCursor();
    //var_dump($threads);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Threadit</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='A simple forum website'>
    <meta name='keywords' content='forum, threads, posts'>
    <meta name='author' content='Threadit'>
    <link rel='stylesheet' type='text/css' href='./css/main.css'>
</head>
<body>
    <?php include('./navbar.php'); ?>
    <main>
        <?php if (isset($_SESSION['userName'])): ?>
            <?php foreach ($threads as $thread): ?>
                <div class="thread">
                    <h2 class="thread-title"><?= $thread['threadTitle'] ?></h2>
                    <p class="thread-subtitle">Created by <?= $thread['userName'] ?> on <?= $thread['threadCreated'] ?></p>
                    <p class="thread-content"><?= substr($thread['threadContent'], 0, 100) ?>...</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <center><h1>Welcome to Threadit</h1>
            <p>Please login to view threads</p>
            <br>
            <iframe src="./img/login.gif" width="500" height="500" frameBorder="0" allowFullScreen></center>
        <?php endif; ?>
    </main>
</body>
</html>

