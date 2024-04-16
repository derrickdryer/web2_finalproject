<!DOCTYPE html>
<html>
    <head>
        <title>New Thread</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <script>
            function updateCountdown() {
                var remaining = 500 - jQuery('#content').val().length;
                jQuery('.countdown').text(remaining + ' characters remaining.');
            }

            jQuery(document).ready(function($) {
                updateCountdown();
                $('#content').change(updateCountdown);
                $('#content').keyup(updateCountdown);
            });
        </script>
    </head>
    <body>
        <?php include('../navbar.php'); ?>

        <form action="post_thread.php" method="post">
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

            <input type="submit" value="Submit">
        </form>
    </body>
</html>