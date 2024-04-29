<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <h1>Communities</h1>
    <table>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Creation Date</th>
        <th>Actions</th>
        <?php foreach($communities as $community) : ?>
            <tr>
                <td><?php echo $community['communityID']; ?></td>
                <td><?php echo $community['communityName']; ?></td>
                <td><?php echo $community['communityDesc']; ?></td>
                <td><?php echo $community['communityCreated']; ?></td>
                <td>
                    <a href="./index.php?action=dc&communityid=<?php echo $community['communityID']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h1>Users</h1>
    <table>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Creation Date</th>
        <th>Actions</th>
        <?php foreach($users as $user) : ?>
        <tr>
            <td><?php echo $user['userID']; ?></td>
            <td><?php echo $user['userName']; ?></td>
            <td><?php echo $user['userEmail']; ?></td>
            <td><?php echo $user['userCreated']; ?></td>
            <td>
                <a href="./index.php?action=dc&userid=<?php echo $user['userID']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h1>Threads</h1>
    <table>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Creation Date</th>
        <th>Actions</th>
        <?php foreach($threads as $thread) : ?>
        <tr>
            <td><?php echo $thread['threadID']; ?></td>
            <td><?php echo $thread['threadTitle']; ?></td>
            <td><?php echo $thread['threadContent']; ?></td>
            <td><?php echo $thread['threadCreated']; ?></td>
            <td>
                <a href="./index.php?action=dt&threadid=<?php echo $thread['threadID']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
</body>
</html>