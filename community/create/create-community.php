<!DOCTYPE html>
<html>
<head>
    <title>Create Community</title>
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
</head>
<body>
    <?php include('../../navbar.php'); ?>
    <form action="./index.php" method="post">
        <label for="communityName">Community Name:</label>
        <input type="text" id="communityName" name="communityName">
        <label for="communityDesc">Community Description:</label>
        <textarea id="communityDesc" name="communityDesc"></textarea>
        <label for="Privacy">Privacy:</label>
        <select id="Privacy" name="Privacy">
            <option value="public">Public</option>
            <option value="private">Private</option>
        <input type="submit" value="Create" name="submit">
    </form>
</body>
</html>