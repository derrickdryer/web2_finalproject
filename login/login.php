<!DOCTYPE html>
<html>
    <head>
        <title>Threadit - Login</title>
        <link rel='stylesheet' type='text/css' href='./css/main.css'>
    </head>
    <body>
        <!-- Basic Login Form via GET Method -->
        <div id="login">
            <h1>Login</h1>
            <div id="login-form">
                <form action="" method="GET">
                    <?php if ($error != "") { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>
                    <label for="userName">Username: </label>
                    <input type="text" name="userName" value="">
                    <label for="userPassword">Password: </label>
                    <input type="password" name="userPassword" value="">
                    <button type="submit" name="action" value="login">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>