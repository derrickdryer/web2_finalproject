<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
</head>
<body>
    <?php include('../../navbar.php'); ?>
    <h2>User Join Requests</h2>
    <ul>
        <?php foreach($join_requests as $request) : ?>
            <li>
                <h3><?php echo $request['userName']; ?></h3>
                <form action="./index.php" method="post">
                    <input type="hidden" name="requestID" value="<?php echo $request['requestID']; ?>">
                    <input type="submit" name="action" value="Accept">
                    <input type="submit" name="action" value="Deny">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>