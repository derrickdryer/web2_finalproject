<!DOCTYPE html>
<html>
<head>
    <title>Community</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <div class="sidebar">
        <!-- Community information goes here -->
        <h3><?= $community['communityName'] ?></h3>
        <p><?= $community['communityDesc'] ?></p>
        <?php if ($role == 'admin'): ?>
            <a href="http://localhost/web2_finalproject/community/admin/index.php?communityID=<?php echo $community['communityID']; ?>">Admin Dashboard</a>
        <?php endif; ?>
    </div>
    <div class="content">
        <!-- Threads go here -->
        <?php foreach ($threads as $thread): ?>
            <div class="thread">
                <h2 class="thread-title"><?= $thread['threadTitle'] ?></h2>
                <p class="thread-content"><?= $thread['threadContent'] ?></p>
                <p class="thread-author">Posted by: <?= $thread['userName'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>