<div id='navbar'>
    <h1>Threadit</h1>
    <div class="nav-buttons">
        <?php if (!isset($isHomePage)) : ?>
            <div class="dropdown">
                <button class="dropbtn" onclick="location.href='http://localhost/web2_finalproject/'">Home</button>
            </div>
        <?php endif; ?>
            <?php if (isset($_SESSION['userName'])) : ?>
                <?php if (!isset($isNewThreadPage)) : ?>
                    <div class="dropdown">
                        <button class="dropbtn" onclick="location.href='http://localhost/web2_finalproject/thread/'">New Thread</button>
                    </div>
                <?php endif; ?>
                <?php if (!isset($isCommunityPage)) : ?>
                    <div class="dropdown">
                        <button class="dropbtn">Communities</button>
                        <div class="dropdown-content">
                            <a href="http://localhost/web2_finalproject/community/user_communities.php">My Communities</a>
                            <a href="http://localhost/web2_finalproject/community/join/">Join Community</a>
                            <a href="http://localhost/web2_finalproject/community/create">Create Community</a>
                        </div>
                    </div>
        <?php endif; endif; ?>
        <div class="dropdown">
        <button class="dropbtn"><?php if (isset($_SESSION['userName'])) { echo $_SESSION['userName']; } else { echo 'Account';} ?></button>
            <div class="dropdown-content">
                <?php
                    if (isset($_SESSION['userName'])) {
                        // User is logged in
                        echo '<a href="./profile/">Profile</a>';
                        if ($_SESSION['userName'] == 'admin') {
                            echo '<a href="http://localhost/web2_finalproject/admin">Admin</a>';
                        }
                        if (isset($isHomePage) && $isHomePage == true) {
                            echo '<a href="http://localhost/web2_finalproject/logout">Logout</a>';
                        } else {
                            echo '<a href="http://localhost/web2_finalproject/logout">Logout</a>';
                        }
                    } else {
                        // User is not logged in
                        if (isset($isHomePage) && $isHomePage == true) {
                            echo '<a href="http://localhost/web2_finalproject/login">Login</a>';
                            echo '<a href="http://localhost/web2_finalproject/register/">Register</a>';
                        } else {
                            echo '<a href="http://localhost/web2_finalproject/login/">Login</a>';
                            echo '<a href="http://localhost/web2_finalproject/register/">Register</a>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>