<?php
    $isNewThreadPage = true;
    // Check to see if session is already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>New Thread</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <?php include('../navbar.php'); ?>
</body>
</html>