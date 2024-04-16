<!DOCTYPE html>
<html>
    <head>
        <title>New Thread</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
    </head>
    <body>
        <?php include('../navbar.php'); ?>
        <h1><?php echo $error; ?></h1>
        <form action="./index.php" method="post">
            <label for="community">Choose a community:</label>
            <select name="community" id="community">
                <?php foreach ($communities as $community): ?>
                    <option value="<?php echo $community['communityID']; ?>">
                    <?php echo $community['communityName']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="title">Title:</label>
            <input type="text" id="title" name="title">

            <label for="content">Content:</label>
            <textarea id="content" name="content" maxlength="500"></textarea>
            <div class="countdown"></div>

            <input type="submit" value="submit" name="submit">
        </form>
    </body>
</html>