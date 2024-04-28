<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Communities</title>
    <link rel="stylesheet" href="../../css/main.css">
</head>
<body>
    <?php include('../../navbar.php'); ?>
    <center><h2>Communities</h2></center>
    <ul>
    <?php foreach($communities as $community) : ?>
        <li>
            <h3><?php echo $community['communityName']; ?></h3>
            <p><?php echo $community['communityDesc']; ?></p>
            <form action="./index.php" method="post">
                <input type="hidden" name="id" value="<?php echo $community['communityID']; ?>">
                <input type="submit" name="action" value="<?php echo ($community['communityPrivacy'] == 0) ? 'Join' : 'Request to Join'; ?>">
            </form>
        </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>